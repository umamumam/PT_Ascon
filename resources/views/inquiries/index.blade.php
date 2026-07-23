<x-app-layout>
    <!-- CSS Khusus untuk Chat Layout Bawaan Vuexy -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <style>
        /* Override beberapa style agar menyatu sempurna dengan layout */
        .app-chat {
            height: 640px !important;
        }
        .chat-contact-list-item.active a {
            background-color: rgba(115, 103, 240, 0.08) !important;
            border-left: 3px solid #7367f0;
        }
        .chat-contact-list-item.unread .chat-contact-name {
            font-weight: 700 !important;
            color: #000000 !important;
        }
        .wix-style-inquiry-box {
            background-color: #f0f3f8;
            border-radius: 12px;
            padding: 16px;
            border: 1px solid #e2e8f0;
            max-width: 550px;
            margin-bottom: 12px;
        }
        .wix-style-inquiry-box label {
            font-size: 0.7rem;
            text-transform: uppercase;
            font-weight: 700;
            color: #718096;
            margin-bottom: 1px;
            display: block;
        }
        .wix-style-inquiry-box .value {
            font-size: 0.9rem;
            color: #1a202c;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .wix-style-inquiry-box .value:last-child {
            margin-bottom: 0;
        }
        .wix-style-inquiry-box h6 {
            color: #7367f0;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .chat-reply-section {
            border-top: 1px solid #e2e8f0;
            background-color: #ffffff;
            padding: 15px;
        }
        .avatar-initial-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-weight: 700;
            font-size: 0.95rem;
        }
    </style>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-chat card overflow-hidden">
            <div class="row g-0 h-100">
                
                <!-- Chats Sidebar Left (List Customer Inquiries) -->
                <div class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end h-100 d-flex flex-column" id="app-chat-contacts" style="width: 320px; min-width: 320px;">
                    <div class="sidebar-header h-px-75 px-5 border-bottom d-flex align-items-center justify-content-between">
                        <h5 class="m-0 fw-bold text-dark">Inbox Messages</h5>
                        <span class="badge bg-label-primary" id="inbox-count-badge">{{ $inquiries->count() }} Messages</span>
                    </div>
                    
                    <div class="sidebar-body flex-grow-1 overflow-auto" id="sidebar-contacts-scrollbar">
                        <ul class="list-unstyled chat-contact-list mb-0 py-2" id="chat-contact-list">
                            @forelse($inquiries as $index => $inquiry)
                                @php
                                    // Generate warna avatar random berdasarkan ID
                                    $colors = ['bg-primary', 'bg-secondary', 'bg-success', 'bg-danger', 'bg-warning', 'bg-info', 'bg-dark'];
                                    $colorClass = $colors[$inquiry->id % count($colors)];
                                    $initials = strtoupper(substr($inquiry->first_name, 0, 1) . substr($inquiry->last_name ?? '', 0, 1));
                                @endphp
                                <li class="chat-contact-list-item mb-1 {{ $inquiry->is_read ? '' : 'unread' }}" data-id="{{ $inquiry->id }}">
                                    <a class="d-flex align-items-center py-2 px-4 cursor-pointer text-decoration-none" onclick="loadInquiryDetail({{ json_encode($inquiry) }}, '{{ $initials }}', '{{ $colorClass }}', this)">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-initial-circle {{ $colorClass }}">
                                                {{ $initials }}
                                            </div>
                                        </div>
                                        <div class="chat-contact-info flex-grow-1 ms-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="chat-contact-name text-truncate m-0 fw-normal">{{ $inquiry->first_name }} {{ $inquiry->last_name }}</h6>
                                                <small class="text-muted text-nowrap" style="font-size: 0.7rem;">{{ $inquiry->created_at->format('d M') }}</small>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-1">
                                                <small class="chat-contact-status text-truncate text-muted m-0" style="max-width: 170px;">{{ $inquiry->subject ?? 'No Subject' }}</small>
                                                @if(!$inquiry->is_read)
                                                    <span class="badge badge-dot bg-danger border ms-2" id="unread-dot-{{ $inquiry->id }}" style="width: 8px; height: 8px;"></span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="text-center py-5 text-muted">No messages in inbox.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- Chat History Right (Detail Message & Wix-Style Reply Form) -->
                <div class="col app-chat-history h-100 d-flex flex-column" id="chat-history-container" style="background-color: #fafbfc;">
                    
                    <!-- Welcome Screen (When no inquiry is selected yet) -->
                    <div id="welcome-chat-screen" class="flex-grow-1 d-flex flex-column align-items-center justify-content-center text-center p-5">
                        <img src="{{ asset('assets/img/illustrations/auth-verify-email-illustration-light.png') }}" 
                             alt="Verify Email Illustration" 
                             class="mb-4" 
                             style="max-width: 170px; height: auto; object-fit: contain;" />
                        <h4 class="fw-bold text-dark">Welcome to Wix-Style Inbox</h4>
                        <p class="text-muted" style="max-width: 360px;">Select a customer message from the left list to view detailed inquiries and reply via email.</p>
                    </div>

                    <!-- Dynamic Chat Details Section (Hidden by default, shown when selected) -->
                    <div id="detail-chat-screen" class="d-none flex-grow-1 d-flex flex-column h-100 overflow-hidden">
                        
                        <!-- Chat Header -->
                        <div class="chat-history-header border-bottom bg-white px-5 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex overflow-hidden align-items-center">
                                    <div class="flex-shrink-0">
                                        <div id="header-avatar" class="avatar-initial-circle">AP</div>
                                    </div>
                                    <div class="chat-contact-info flex-grow-1 ms-3">
                                        <h6 id="header-name" class="m-0 fw-bold text-dark">Agung Prasetyo</h6>
                                        <small id="header-email" class="text-muted">agung.prasetyo@example.com</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <!-- Form Delete -->
                                    <form id="delete-inquiry-form-dynamic" action="" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDeleteDynamic()">
                                            <i class="ti ti-trash me-1"></i> Delete Message
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Chat Body (Gelembung Chat asli Vuexy) -->
                        <div class="chat-history-body flex-grow-1 overflow-auto bg-white p-5" id="chat-history-body-scrollbar">
                            <ul class="list-unstyled chat-history mb-0">
                                <li class="chat-message">
                                    <div class="d-flex overflow-hidden">
                                        <div class="user-avatar flex-shrink-0 me-4">
                                            <div id="body-avatar" class="avatar-initial-circle">AP</div>
                                        </div>
                                        <div class="chat-message-wrapper flex-grow-1">
                                            <div class="chat-message-text" style="max-width: 85%;">
                                                <div class="mb-2">
                                                    <label class="text-uppercase text-muted fw-bold d-block" style="font-size: 0.65rem; letter-spacing: 0.5px;">Subject</label>
                                                    <strong class="text-primary" id="body-subject">Rate Inquiry to Shanghai</strong>
                                                </div>
                                                <hr class="my-2" style="opacity: 0.1;">
                                                <div>
                                                    <label class="text-uppercase text-muted fw-bold d-block" style="font-size: 0.65rem; letter-spacing: 0.5px;">Message</label>
                                                    <p class="mb-0 text-dark" id="body-message" style="white-space: pre-wrap; line-height: 1.6; font-size: 0.92rem;">
                                                        Halo, saya ingin menanyakan rate pengiriman kontainer LCL dari Jakarta ke Shanghai. Terima kasih.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="text-muted mt-1">
                                                <small id="body-date">Saturday, 18 July 2026 - 16:21 WIB</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- Chat Footer (Input balas minimalis) -->
                        <div class="chat-history-footer shadow-xs bg-white border-top p-3">
                            <form id="email-reply-form" onsubmit="handleSendReplyEmail(event)" class="d-flex align-items-center w-100 m-0">
                                <textarea id="reply-body-text" class="form-control message-input border-0 me-3 shadow-none bg-transparent" placeholder="Type your reply message here..." required style="resize: none; font-size: 0.95rem;" rows="2"></textarea>
                                <button type="submit" class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2" style="border-radius: 8px; min-width: 100px; justify-content: center;">
                                    <span>Send</span>
                                    <i class="ti ti-send"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- JS Perfect Scrollbar & Interaksi App Chat -->
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script>
        let currentSelectedInquiryId = null;
        let currentInquiryEmail = '';
        let currentInquirySubject = '';

        document.addEventListener('DOMContentLoaded', function () {
            // Inisialisasi Perfect Scrollbar
            const sidebarScroll = document.getElementById('sidebar-contacts-scrollbar');
            const chatBodyScroll = document.getElementById('chat-history-body-scrollbar');
            
            if (sidebarScroll) {
                new PerfectScrollbar(sidebarScroll, { wheelPropagation: false });
            }
        });

        // Load detail inquiry ke panel kanan
        function loadInquiryDetail(inquiry, initials, colorClass, element) {
            currentSelectedInquiryId = inquiry.id;
            currentInquiryEmail = inquiry.email;
            currentInquirySubject = 'Re: ' + (inquiry.subject || 'Inquiry');

            // 1. Ganti tampilan dari welcome screen ke detail screen
            document.getElementById('welcome-chat-screen').classList.add('d-none');
            document.getElementById('detail-chat-screen').classList.remove('d-none');

            // 2. Set item sidebar active style
            const listItems = document.querySelectorAll('#chat-contact-list li');
            listItems.forEach(item => item.classList.remove('active'));
            
            const parentLi = element.closest('li');
            parentLi.classList.add('active');

            // 3. Render Header Info (Nama + Email)
            const headerAvatar = document.getElementById('header-avatar');
            headerAvatar.className = 'avatar-initial-circle ' + colorClass;
            headerAvatar.innerText = initials;
            document.getElementById('header-name').innerText = inquiry.first_name + ' ' + (inquiry.last_name || '');
            document.getElementById('header-email').innerText = inquiry.email;

            // 4. Render Body Box Info (Gelembung Chat)
            const bodyAvatar = document.getElementById('body-avatar');
            bodyAvatar.className = 'avatar-initial-circle ' + colorClass;
            bodyAvatar.innerText = initials;

            document.getElementById('body-subject').innerText = inquiry.subject || 'No Subject';
            document.getElementById('body-message').innerText = inquiry.message;

            // Format received date
            const dateStr = new Date(inquiry.created_at).toLocaleString('id-ID', {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit'
            }) + ' WIB';
            document.getElementById('body-date').innerText = dateStr;

            // Set Form Delete Action Route secara dinamis
            document.getElementById('delete-inquiry-form-dynamic').action = "/cms/inquiries/" + inquiry.id;

            // Reset Reply Input
            document.getElementById('reply-body-text').value = '';

            // 5. Tandai pesan sebagai telah dibaca (is_read = true) melalui AJAX
            if (parentLi.classList.contains('unread')) {
                markInquiryAsRead(inquiry.id, parentLi);
            }

            // Reset scroll chat body ke atas
            const chatBodyScroll = document.getElementById('chat-history-body-scrollbar');
            if (chatBodyScroll) {
                chatBodyScroll.scrollTop = 0;
            }
        }

        // Tandai pesan terbaca via AJAX
        function markInquiryAsRead(id, liElement) {
            fetch('/cms/inquiries/' + id + '/read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Hapus bold styling (unread class)
                    liElement.classList.remove('unread');
                    
                    // Hapus red dot di sidebar list
                    const dot = document.getElementById('unread-dot-' + id);
                    if (dot) dot.remove();

                    // Update Lencana Notifikasi Lonceng di Navbar atas secara dinamis!
                    const bellIcon = document.querySelector('.ti-bell');
                    if (bellIcon) {
                        const navBadge = bellIcon.closest('.position-relative').querySelector('.badge');
                        if (navBadge) {
                            if (data.unread_count > 0) {
                                navBadge.innerText = data.unread_count;
                            } else {
                                navBadge.remove(); // Hapus lencana merah jika unread count = 0
                            }
                        }
                    }
                }
            })
            .catch(error => console.error('Error marking as read:', error));
        }

        // Kirim balasan via mailto dinamis
        function handleSendReplyEmail(event) {
            event.preventDefault();
            const body = document.getElementById('reply-body-text').value;

            // Membuka email client bawaan dengan template pesan
            const mailtoUrl = `mailto:${currentInquiryEmail}?subject=${encodeURIComponent(currentInquirySubject)}&body=${encodeURIComponent(body)}`;
            window.location.href = mailtoUrl;

            // Reset textarea setelah dikirim
            document.getElementById('reply-body-text').value = '';
        }

        // Konfirmasi Delete
        function confirmDeleteDynamic() {
            Swal.fire({
                title: 'Are you sure?',
                text: "This customer message will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ea5455',
                cancelButtonColor: '#8592a3',
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'btn btn-danger me-3',
                    cancelButton: 'btn btn-label-secondary'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-inquiry-form-dynamic').submit();
                }
            });
        }
    </script>
</x-app-layout>

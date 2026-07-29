<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Inquiry;
use App\Models\Setting;

class CustomerRegistrationController extends Controller
{
    /**
     * Display the Customer Registration Guide overview page.
     */
    public function index()
    {
        return redirect()->route('public.customer-registration.form');
    }

    /**
     * Display the dedicated Registration Form page.
     */
    public function form()
    {
        $settings = Setting::pluck('value', 'key')->all();
        return view('customer-registration-form', compact('settings'));
    }

    /**
     * Handle registration form submission and send email to specified recipient.
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'full_name'    => 'required|string|max:100',
            'email'        => 'required|email|max:100',
            'target_email' => 'required|email|max:100',
            'subject'      => 'required|string|max:150',
            'message'      => 'required|string|max:2000',
        ]);

        // Save to Database (Inquiries table) for backup
        try {
            $nameParts = explode(' ', trim($validated['full_name']), 2);
            Inquiry::create([
                'first_name' => $nameParts[0] ?? $validated['full_name'],
                'last_name'  => $nameParts[1] ?? '',
                'email'      => $validated['email'],
                'subject'    => '[Registration Request] ' . $validated['subject'],
                'message'    => "Target Recipient: " . $validated['target_email'] . "\n\n" . $validated['message'],
                'is_read'    => false,
            ]);
        } catch (\Exception $e) {
            Log::warning('Could not save inquiry record: ' . $e->getMessage());
        }

        // HTML Body Content
        $htmlContent = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 25px; border: 1px solid #e2e8f0; border-radius: 12px; background-color: #ffffff;'>
                <div style='background: linear-gradient(135deg, #0f4c81 0%, #1e3a8a 100%); padding: 20px; border-radius: 8px; text-align: center; margin-bottom: 20px;'>
                    <h2 style='color: #ffffff; margin: 0; font-size: 20px;'>ASCON Customer Portal Registration Request</h2>
                </div>

                <table style='width: 100%; border-collapse: collapse; margin-bottom: 20px;'>
                    <tr>
                        <td style='padding: 8px 0; color: #64748b; font-size: 14px; width: 140px;'><strong>Full Name:</strong></td>
                        <td style='padding: 8px 0; color: #0f172a; font-size: 14px;'><strong>" . e($validated['full_name']) . "</strong></td>
                    </tr>
                    <tr>
                        <td style='padding: 8px 0; color: #64748b; font-size: 14px;'><strong>Sender Email:</strong></td>
                        <td style='padding: 8px 0; color: #0f172a; font-size: 14px;'>" . e($validated['email']) . "</td>
                    </tr>
                    <tr>
                        <td style='padding: 8px 0; color: #64748b; font-size: 14px;'><strong>Target Recipient:</strong></td>
                        <td style='padding: 8px 0; color: #0f4c81; font-size: 14px; font-weight: bold;'>" . e($validated['target_email']) . "</td>
                    </tr>
                    <tr>
                        <td style='padding: 8px 0; color: #64748b; font-size: 14px;'><strong>Subject:</strong></td>
                        <td style='padding: 8px 0; color: #0f172a; font-size: 14px;'>" . e($validated['subject']) . "</td>
                    </tr>
                </table>

                <div style='background-color: #f8fafc; padding: 15px; border-left: 4px solid #0f4c81; border-radius: 4px; margin-bottom: 20px;'>
                    <p style='margin: 0 0 8px 0; color: #475569; font-size: 13px; font-weight: bold; text-transform: uppercase;'>Message Content:</p>
                    <div style='color: #334155; font-size: 14px; line-height: 1.6; white-space: pre-wrap;'>" . nl2br(e($validated['message'])) . "</div>
                </div>

                <p style='font-size: 12px; color: #94a3b8; text-align: center; margin-top: 25px;'>
                    This email was sent automatically from PT Asia Connexindo Internasional Customer Portal via Resend API.
                </p>
            </div>
        ";

        $mailSent = false;
        $mailError = null;

        // Try Resend HTTP API first
        $resendApiKey = env('RESEND_API_KEY');
        if ($resendApiKey) {
            try {
                $resendResponse = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $resendApiKey,
                    'Content-Type'  => 'application/json',
                ])->withoutVerifying()->post('https://api.resend.com/emails', [
                    'from'     => 'PT Asia Connexindo <onboarding@resend.dev>',
                    'to'       => [$validated['target_email']],
                    'reply_to' => $validated['email'],
                    'subject'  => '[Registration Request] ' . $validated['subject'],
                    'html'     => $htmlContent,
                ]);

                if ($resendResponse->successful()) {
                    $mailSent = true;
                } else {
                    $resendBody = $resendResponse->json();
                    $mailError = $resendBody['message'] ?? $resendResponse->body();
                }
            } catch (\Exception $e) {
                Log::warning('Resend API exception: ' . $e->getMessage());
                $mailError = $e->getMessage();
            }
        }

        // Fallback to Laravel Mailer if Resend API failed
        if (!$mailSent) {
            try {
                Mail::html($htmlContent, function ($message) use ($validated) {
                    $message->to($validated['target_email'])
                            ->from(config('mail.from.address', 'onboarding@resend.dev'), config('mail.from.name', 'PT Asia Connexindo'))
                            ->replyTo($validated['email'], $validated['full_name'])
                            ->subject('[Registration Request] ' . $validated['subject']);
                });
                $mailSent = true;
            } catch (\Exception $e) {
                Log::error('Laravel Mailer Error: ' . $e->getMessage());
                if (!$mailError) {
                    $mailError = $e->getMessage();
                }
            }
        }

        return response()->json([
            'success'   => true,
            'mail_sent' => $mailSent,
            'message'   => $mailSent
                ? 'Registration request email sent successfully to ' . $validated['target_email'] . '!'
                : 'Registration data recorded! (Notice: ' . $mailError . ')',
        ]);
    }
}

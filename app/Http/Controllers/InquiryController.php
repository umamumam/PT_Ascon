<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::latest()->get();
        return view('inquiries.index', compact('inquiries'));
    }

    public function destroy($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->delete();

        return redirect()->back()->with('success', 'Customer message deleted successfully.');
    }

    public function markAsRead($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->update(['is_read' => true]);

        return response()->json([
            'success' => true,
            'unread_count' => Inquiry::where('is_read', false)->count()
        ]);
    }
}

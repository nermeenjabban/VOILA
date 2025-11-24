<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        // البحث
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('subject', 'like', '%' . $request->search . '%')
                  ->orWhere('message', 'like', '%' . $request->search . '%');
            });
        }

        // التصفية حسب الحالة
        if ($request->has('status') && $request->status != '') {
            if ($request->status == 'reviewed') {
                $query->where('reviewed', true);
            } elseif ($request->status == 'unread') {
                $query->where('reviewed', false);
            }
        }

        $messages = $query->latest()->paginate(15);

        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        // تحديث الرسالة كمقروءة عند عرضها
        if (!$contactMessage->reviewed) {
            $contactMessage->update(['reviewed' => true]);
        }

        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    public function markAsReviewed(ContactMessage $contactMessage)
    {
        $contactMessage->update(['reviewed' => true]);

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'تم تحديد الرسالة كمقروءة بنجاح.');
    }

    public function markAsUnread(ContactMessage $contactMessage)
    {
        $contactMessage->update(['reviewed' => false]);

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'تم تحديد الرسالة كغير مقروءة بنجاح.');
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'تم حذف الرسالة بنجاح.');
    }

    public function bulkAction(Request $request)
    {
        $action = $request->action;
        $messageIds = $request->message_ids;

        if (!$messageIds) {
            return redirect()->back()->with('error', 'لم يتم اختيار أي رسائل.');
        }

        switch ($action) {
            case 'mark-reviewed':
                ContactMessage::whereIn('id', $messageIds)->update(['reviewed' => true]);
                $message = 'تم تحديد الرسائل المحددة كمقروءة بنجاح.';
                break;

            case 'mark-unread':
                ContactMessage::whereIn('id', $messageIds)->update(['reviewed' => false]);
                $message = 'تم تحديد الرسائل المحددة كغير مقروءة بنجاح.';
                break;

            case 'delete':
                ContactMessage::whereIn('id', $messageIds)->delete();
                $message = 'تم حذف الرسائل المحددة بنجاح.';
                break;

            default:
                return redirect()->back()->with('error', 'الإجراء غير صحيح.');
        }

        return redirect()->route('admin.contact-messages.index')->with('success', $message);
    }

    public function getStats()
    {
        $totalMessages = ContactMessage::count();
        $unreadMessages = ContactMessage::where('reviewed', false)->count();
        $readMessages = ContactMessage::where('reviewed', true)->count();

        return [
            'total' => $totalMessages,
            'unread' => $unreadMessages,
            'read' => $readMessages
        ];
    }
}
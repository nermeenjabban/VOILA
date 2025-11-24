<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::with(['article', 'article.author']);

        // البحث
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('author_name', 'like', '%' . $request->search . '%')
                  ->orWhere('author_email', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        // التصفية حسب الحالة
        if ($request->has('status') && $request->status != '') {
            if ($request->status == 'approved') {
                $query->where('approved', true);
            } elseif ($request->status == 'pending') {
                $query->where('approved', false);
            }
        }

        // التصفية حسب المقال
        if ($request->has('article_id') && $request->article_id != '') {
            $query->where('article_id', $request->article_id);
        }

        $comments = $query->latest()->paginate(15);
        $articles = Article::where('is_published', true)->get();

        return view('admin.comments.index', compact('comments', 'articles'));
    }

    public function show(Comment $comment)
    {
        $comment->load(['article', 'article.author']);
        return view('admin.comments.show', compact('comment'));
    }

    public function approve(Comment $comment)
    {
        $comment->update(['approved' => true]);

        return redirect()->route('admin.comments.index')
            ->with('success', 'تمت الموافقة على التعليق بنجاح.');
    }

    public function disapprove(Comment $comment)
    {
        $comment->update(['approved' => false]);

        return redirect()->route('admin.comments.index')
            ->with('success', 'تم إلغاء الموافقة على التعليق بنجاح.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.comments.index')
            ->with('success', 'تم حذف التعليق بنجاح.');
    }

    public function bulkAction(Request $request)
    {
        $action = $request->action;
        $commentIds = $request->comment_ids;

        if (!$commentIds) {
            return redirect()->back()->with('error', 'لم يتم اختيار أي تعليقات.');
        }

        switch ($action) {
            case 'approve':
                Comment::whereIn('id', $commentIds)->update(['approved' => true]);
                $message = 'تمت الموافقة على التعليقات المحددة بنجاح.';
                break;

            case 'disapprove':
                Comment::whereIn('id', $commentIds)->update(['approved' => false]);
                $message = 'تم إلغاء الموافقة على التعليقات المحددة بنجاح.';
                break;

            case 'delete':
                Comment::whereIn('id', $commentIds)->delete();
                $message = 'تم حذف التعليقات المحددة بنجاح.';
                break;

            default:
                return redirect()->back()->with('error', 'الإجراء غير صحيح.');
        }

        return redirect()->route('admin.comments.index')->with('success', $message);
    }

    // تعطيل/تفعيل التعليقات لمقال معين
    public function toggleArticleComments(Article $article)
    {
        $article->update([
            'comments_enabled' => !$article->comments_enabled
        ]);

        $status = $article->comments_enabled ? 'مفعل' : 'معطل';
        return redirect()->back()->with('success', "تم $status التعليقات لهذا المقال بنجاح.");
    }
}
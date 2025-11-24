<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function show($id)
    {
        $article = Article::with(['category', 'author', 'approvedComments'])
                        ->where('is_published', true)
                        ->findOrFail($id);

        // المقالات ذات الصلة (نفس التصنيف)
        $relatedArticles = Article::where('category_id', $article->category_id)
                                ->where('id', '!=', $article->id)
                                ->where('is_published', true)
                                ->with('category', 'author')
                                ->latest()
                                ->take(3)
                                ->get();

        return view('frontend.articles.show', compact('article', 'relatedArticles'));
    }

    public function storeComment(Request $request, $articleId)
    {
        $article = Article::where('is_published', true)->findOrFail($articleId);
    
        // التحقق من إمكانية التعليق على المقال
        if (!$article->comments_enabled) {
            return redirect()->back()
                ->with('error', 'التعليقات معطلة على هذا المقال.');
        }
    
        $request->validate([
            'author_name' => 'required|string|max:255',
            'author_email' => 'required|email|max:255',
            'content' => 'required|string|min:5|max:1000',
        ]);
    
        Comment::create([
            'article_id' => $article->id,
            'author_name' => $request->author_name,
            'author_email' => $request->author_email,
            'content' => $request->content,
            'approved' => false,
        ]);
    
        return redirect()->route('articles.show', $article->id)
                        ->with('success', 'تم إرسال تعليقك بنجاح وسيظهر بعد المراجعة.');
    }
}
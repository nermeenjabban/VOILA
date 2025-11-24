<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['category', 'author']);
        

        // البحث
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        // التصفية حسب التصنيف
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        // التصفية حسب الحالة
        if ($request->has('status') && $request->status != '') {
            if ($request->status == 'published') {
                $query->where('is_published', true);
            } elseif ($request->status == 'draft') {
                $query->where('is_published', false);
            }
        }

        $articles = $query->latest()->paginate(10);
        $categories = Category::all();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->slug = Str::slug($request->title);
        $article->content = $request->content;
        $article->category_id = $request->category_id;
        $article->author_id = auth()->id();
        $article->is_published = $request->has('is_published');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $article->image = $imagePath;
        }

        if ($article->is_published) {
            $article->published_at = now();
        }

        $article->save();

        return redirect()->route('admin.articles.index')
            ->with('success', 'تم إنشاء المقال بنجاح.');
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
        ]);

        $article->title = $request->title;
        $article->slug = Str::slug($request->title);
        $article->content = $request->content;
        $article->category_id = $request->category_id;
        
        // إذا كانت المقالة غير منشورة وأصبحت منشورة
        if (!$article->is_published && $request->has('is_published')) {
            $article->published_at = now();
        }
        
        $article->is_published = $request->has('is_published');

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            
            $imagePath = $request->file('image')->store('articles', 'public');
            $article->image = $imagePath;
        }

        $article->save();

        return redirect()->route('admin.articles.index')
            ->with('success', 'تم تحديث المقال بنجاح.');
    }

    public function destroy(Article $article)
    {
        // حذف الصورة إذا كانت موجودة
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'تم حذف المقال بنجاح.');
    }

    public function togglePublish(Article $article)
    {
        $article->is_published = !$article->is_published;
        
        if ($article->is_published && !$article->published_at) {
            $article->published_at = now();
        }
        
        $article->save();

        $message = $article->is_published ? 'تم نشر المقال بنجاح.' : 'تم إلغاء نشر المقال.';

        return redirect()->back()->with('success', $message);
    }

    public function toggleArticleComments(Article $article)
{
    $article->update([
        'comments_enabled' => !$article->comments_enabled
    ]);

    $status = $article->comments_enabled ? 'مفعل' : 'معطل';
    return redirect()->back()->with('success', "تم $status التعليقات لهذا المقال بنجاح.");
}
}
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
        
        // إذا كان المستخدم محرراً، يرى فقط مقالاته
        if (auth()->user()->role === 'editor') {
            $query->where('author_id', auth()->id());
        }
        
        // البحث والتصفية
        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        
        if ($request->has('status') && $request->status) {
            $query->where('is_published', $request->status === 'published');
        }
        
        $articles = $query->latest()->paginate(10);
        $categories = \App\Models\Category::all();
        
        return view('admin.articles.index', compact('articles', 'categories'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
            'comments_enabled' => 'boolean',
        ]);
    
        // معالجة الصورة - تخزين في public/articles/
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // إنشاء اسم فريد للصورة
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            // نقل الصورة إلى public/articles/
            $image->move(public_path('articles'), $imageName);
            
            // حفظ المسار الكامل في الداتابيس: articles/اسم_الصورة
            $validated['image'] = 'articles/' . $imageName;
        }
    
        $validated['author_id'] = auth()->id();
        $validated['slug'] = Str::slug($request->title);
        $validated['is_published'] = $request->has('is_published');
        $validated['comments_enabled'] = $request->has('comments_enabled');
    
        Article::create($validated);
    
        return redirect()->route('admin.articles.index')
            ->with('success', 'تم إنشاء المقال بنجاح');
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
            'comments_enabled' => 'boolean',
        ]);
    
        // معالجة الصورة - تخزين في public/articles/
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا موجودة
            if ($article->image && file_exists(public_path($article->image))) {
                unlink(public_path($article->image));
            }
    
            $image = $request->file('image');
            
            // إنشاء اسم فريد للصورة
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            // نقل الصورة إلى public/articles/
            $image->move(public_path('articles'), $imageName);
            
            // حفظ المسار الكامل في الداتابيس: articles/اسم_الصورة
            $validated['image'] = 'articles/' . $imageName;
        }
    
        $validated['slug'] = Str::slug($request->title);
        $validated['is_published'] = $request->has('is_published');
        $validated['comments_enabled'] = $request->has('comments_enabled');
    
        $article->update($validated);
    
        return redirect()->route('admin.articles.index')
            ->with('success', 'تم تحديث المقال بنجاح');
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function preview(Article $article)
{
    // معاينة المقال حتى لو كان مسودة
    return view('articles.show', compact('article'));
}

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
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
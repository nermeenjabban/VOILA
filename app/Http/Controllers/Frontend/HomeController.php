<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
{
    // البحث والتصفية
    $query = $request->get('q');
    $category_id = $request->get('category_id');

    // جلب المقالات مع البحث والتصفية
    $articles = Article::where('is_published', true)
                      ->when($query, function($q) use ($query) {
                          return $q->where(function($subQuery) use ($query) {
                              $subQuery->where('title', 'like', "%{$query}%")
                                       ->orWhere('content', 'like', "%{$query}%");
                          });
                      })
                      ->when($category_id, function($q) use ($category_id) {
                          return $q->where('category_id', $category_id);
                      })
                      ->with(['category', 'author'])
                      ->latest()
                      ->paginate(6);

    // جلب التصنيفات
    $categories = Category::all();

    // إرجاع البيانات بدون $category إلا إذا كنا في صفحة تصنيف محددة
    return view('frontend.home', compact('articles', 'categories', 'query', 'category_id'));
}

    public function search(Request $request)
    {
        // إعادة استخدام نفس منطق index
        return $this->index($request);
    }

    // public function category($id)
    // {
    //     // عرض المقالات حسب التصنيف
    //     $category = Category::findOrFail($id);
        
    //     $articles = Article::where('is_published', true)
    //                       ->where('category_id', $id)
    //                       ->with(['category', 'author'])
    //                       ->latest()
    //                       ->paginate(6);

    //     $categories = Category::all();

    //     return view('frontend.home', compact('articles', 'categories', 'category'));
    // }

    public function category($id)
{
    // العثور على التصنيف أو عرض خطأ 404
    $category = Category::findOrFail($id);
    
    // جلب جميع المقالات المنشورة في هذا التصنيف
    $articles = Article::where('is_published', true)
                      ->where('category_id', $id)
                      ->with('category', 'author')
                      ->latest()
                      ->paginate(9); // 9 مقالات في الصفحة

    // جلب جميع التصنيفات للقائمة الجانبية
    $categories = Category::all();

    return view('frontend.categories.show', compact('category', 'articles', 'categories'));
}
}
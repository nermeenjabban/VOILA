<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; // الجميع يمكنهم رؤية قائمة المقالات
    }

    public function view(User $user, Article $article)
    {
        // المحرر يرى فقط مقالاته، المدير يرى الكل
        return $user->role === 'admin' || $article->author_id === $user->id;
    }

    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    public function update(User $user, Article $article)
    {
        return $user->role === 'admin' || $article->author_id === $user->id;
    }

    public function delete(User $user, Article $article)
    {
        return $user->role === 'admin' || $article->author_id === $user->id;
    }

    public function restore(User $user, Article $article)
    {
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, Article $article)
    {
        return $user->role === 'admin';
    }
}
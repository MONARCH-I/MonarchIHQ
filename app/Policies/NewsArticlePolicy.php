<?php

namespace App\Policies;

use App\Models\NewsArticle;
use App\Models\User;

class NewsArticlePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isContentManager();
    }

    public function view(User $user, NewsArticle $article): bool
    {
        return $user->isContentManager();
    }

    public function create(User $user): bool
    {
        return $user->isContentManager();
    }

    public function update(User $user, NewsArticle $article): bool
    {
        return $user->isContentManager();
    }

    public function delete(User $user, NewsArticle $article): bool
    {
        return $user->isContentManager();
    }

    public function publish(User $user, NewsArticle $article): bool
    {
        return $user->isContentManager();
    }
}

<?php

namespace App\Policies;

use App\Models\PortfolioProject;
use App\Models\User;

class PortfolioProjectPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isContentManager();
    }

    public function view(User $user, PortfolioProject $project): bool
    {
        return $user->isContentManager();
    }

    public function create(User $user): bool
    {
        return $user->isContentManager();
    }

    public function update(User $user, PortfolioProject $project): bool
    {
        return $user->isContentManager();
    }

    public function delete(User $user, PortfolioProject $project): bool
    {
        return $user->isContentManager();
    }
}

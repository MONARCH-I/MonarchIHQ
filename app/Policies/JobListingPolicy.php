<?php

namespace App\Policies;

use App\Models\JobListing;
use App\Models\User;

class JobListingPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isHrManager();
    }

    public function view(User $user, JobListing $job): bool
    {
        return $user->isHrManager();
    }

    public function create(User $user): bool
    {
        return $user->isHrManager();
    }

    public function update(User $user, JobListing $job): bool
    {
        return $user->isHrManager();
    }

    public function delete(User $user, JobListing $job): bool
    {
        return $user->isHrManager();
    }
}

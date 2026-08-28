<?php

namespace App\Policies;

use App\Models\ContactMessage;
use App\Models\User;

class ContactMessagePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isHrManager();
    }

    public function view(User $user, ContactMessage $message): bool
    {
        return $user->isHrManager();
    }

    public function update(User $user, ContactMessage $message): bool
    {
        return $user->isHrManager();
    }

    public function delete(User $user, ContactMessage $message): bool
    {
        return $user->isSuperAdmin();
    }

    /** Only HR/super_admin can send email replies */
    public function reply(User $user, ContactMessage $message): bool
    {
        return $user->isHrManager();
    }
}

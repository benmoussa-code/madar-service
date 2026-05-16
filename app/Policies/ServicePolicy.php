<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ServicePolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Service $service): bool
    {
        // If the user is a provider, they can ONLY view their own services
        if ($user->role === 'provider') {
            return $user->id === $service->user_id;
        }

        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Service $service): bool
    {
        return $user->id === $service->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Service $service): bool
    {
        return $user->id === $service->user_id || $user->role === 'admin';
    }
}

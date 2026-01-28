<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\Personnel;
use Illuminate\Auth\Access\Response;

class PersonnelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Client $client): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Client $client, Personnel $personnel): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Client $client): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Client $client, Personnel $personnel): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Client $client, Personnel $personnel): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Client $client, Personnel $personnel): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Client $client, Personnel $personnel): bool
    {
        return false;
    }
}

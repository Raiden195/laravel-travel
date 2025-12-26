<?php

namespace App\Policies;

use App\Models\City;
use App\Models\Client;
use Illuminate\Auth\Access\Response;

class CityPolicy
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
    public function view(Client $client, City $city): bool
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
    public function update(Client $client, City $city): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Client $client, City $city): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Client $client, City $city): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Client $client, City $city): bool
    {
        return false;
    }
}

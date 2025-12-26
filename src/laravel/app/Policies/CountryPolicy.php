<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\Country;
use Illuminate\Auth\Access\Response;

class CountryPolicy
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
    public function view(Client $client, Country $country): bool
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
    public function update(Client $client, Country $country): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Client $client, Country $country): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Client $client, Country $country): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Client $client, Country $country): bool
    {
        return false;
    }
}

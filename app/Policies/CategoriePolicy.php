<?php

namespace App\Policies;

use App\Models\Categorie;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response;

class CategoriePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)//: bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Categorie $categorie)//: bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user)
    {
        if (!$user->isAdmin()) {
            throw new AuthorizationException('Vous n\'êtes pas autorisé à modifier cette catégorie.');
        }
        return true;
    }
    
    public function delete(User $user)
    {
        if (!$user->isAdmin()) {
            throw new AuthorizationException('Vous n\'êtes pas autorisé à supprimer cette catégorie.');
        }
    
        return true;
    }
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Categorie $categorie)//: bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Categorie $categorie)//: bool
    {
        //
    }
}

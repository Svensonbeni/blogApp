<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)//:: bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Article $article)//: bool
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
            throw new AuthorizationException('Vous n\'êtes pas autorisé à modifier cet article.');
        }
        return true;
    }
    
    public function delete(User $user)
    {
        if (!$user->isAdmin()) {
            throw new AuthorizationException('Vous n\'êtes pas autorisé à supprimer cet article.');
        }
    
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Article $article)//:: bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Article $article)//:: bool
    {
        //
    }
}

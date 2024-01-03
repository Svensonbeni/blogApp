<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'slug',
        'description',
        'user_id',
        //'categorie_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }
}

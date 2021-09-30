<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    public function favorites(){
        return $this->hasMany(Favorite::class);
    }

    public function genre(){
        return $this->belongsToMany(Genre::class);
    }

    public function languages(){
        return $this->hasMany(Language::class);
    }

    public function comments(){
        return $this->belongsToMany(Comments::class);
    }

}

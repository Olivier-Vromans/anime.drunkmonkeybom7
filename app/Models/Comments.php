<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    public function anime(){
        return $this->belongsToMany(Anime::class);
    }
    public function user(){
        return $this->belongsToMany(User::class);
    }
}

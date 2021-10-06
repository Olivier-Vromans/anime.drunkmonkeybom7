<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Favorite
 *
 * @property int $id
 * @property int $user_id
 * @property int $anime_id
 * @property-read \App\Models\Anime $anime
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite query()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereAnimeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereUserId($value)
 * @mixin \Eloquent
 */
class Favorite extends Model
{
    use HasFactory;

    public function anime(){
        return $this->belongsTo(Anime::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}

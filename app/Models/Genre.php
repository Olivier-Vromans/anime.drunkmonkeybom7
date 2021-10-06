<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Genre
 *
 * @property int $id
 * @property string $genre_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Anime[] $anime
 * @property-read int|null $anime_count
 * @method static \Illuminate\Database\Eloquent\Builder|Genre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre query()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereGenreName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereId($value)
 * @mixin \Eloquent
 */
class Genre extends Model
{
    use HasFactory;

    public function anime(){
        return $this->belongsToMany(Anime::class);
    }
}

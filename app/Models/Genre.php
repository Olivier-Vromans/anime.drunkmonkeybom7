<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Genre
 *
 * @property int $id
 * @property string $genre_name
 * @property-read Collection|Anime[] $anime
 * @property-read int|null $anime_count
 * @method static Builder|Genre newModelQuery()
 * @method static Builder|Genre newQuery()
 * @method static Builder|Genre query()
 * @method static Builder|Genre whereGenreName($value)
 * @method static Builder|Genre whereId($value)
 * @mixin Eloquent
 */
class Genre extends Model
{
    use HasFactory;

    protected $url = 'https://api.jikan.moe/v4/genres/anime';
    protected $table = 'genres';



    public function anime(): BelongsToMany
    {
        return $this->belongsToMany(Anime::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Anime
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int|null $seasons
 * @property int|null $episodes
 * @property int|null $users_favorite
 * @property int|null $rating
 * @property string|null $premiered
 * @property int|null $comment_id
 * @property string|null $image
 * @property-read Collection|Comments[] $comments
 * @property-read int|null $comments_count
 * @property-read Collection|Favorite[] $favorites
 * @property-read int|null $favorites_count
 * @property-read Collection|Genre[] $genre
 * @property-read int|null $genre_count
 * @method static \Illuminate\Database\Eloquent\Builder|Anime newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Anime newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Anime query()
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereEpisodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereGenreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime wherePremiered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereSeasons($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereUsersFavorite($value)
 * @mixin \Eloquent
 */

class Anime extends Model
{
    use HasFactory;

    protected $table = 'animes';
    public $timestamps = false;


    public function genres(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Comments::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}

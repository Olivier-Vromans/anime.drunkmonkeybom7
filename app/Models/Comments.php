<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Comments
 *
 * @property int $id
 * @property string $comment
 * @property int $comment_rating
 * @property string $comment_date
 * @property int $user_id
 * @property int $anime_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Anime[] $anime
 * @property-read int|null $anime_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $user
 * @property-read int|null $user_count
 * @method static \Illuminate\Database\Eloquent\Builder|Comments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comments query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereAnimeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereCommentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereCommentRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereUserId($value)
 * @mixin \Eloquent
 */
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

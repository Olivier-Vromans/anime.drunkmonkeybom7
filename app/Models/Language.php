<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Language
 *
 * @property int $id
 * @property string $language_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Anime[] $anime
 * @property-read int|null $anime_count
 * @method static \Illuminate\Database\Eloquent\Builder|Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Language query()
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereLanguageName($value)
 * @mixin \Eloquent
 */
class Language extends Model
{
    public function anime(){
        return $this->belongsToMany(Anime::class);
    }
}

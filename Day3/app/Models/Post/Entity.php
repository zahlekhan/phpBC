<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Carbon;

/**
 * App\Models\Post\Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $body
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User\Entity $user
 * @method static Builder|Entity newModelQuery()
 * @method static Builder|Entity newQuery()
 * @method static Builder|Entity query()
 * @method static Builder|Entity whereBody($value)
 * @method static Builder|Entity whereCreatedAt($value)
 * @method static Builder|Entity whereId($value)
 * @method static Builder|Entity whereTitle($value)
 * @method static Builder|Entity whereUpdatedAt($value)
 * @method static Builder|Entity whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment\Entity[] $posts
 * @property-read int|null $posts_count
 */
class Entity extends Model
{
    use HasFactory;

    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User\Entity::class,"user_id","id");
    }

    public function comments()
    {
        return $this->hasMany(Comment\Entity::class,"post_id");
    }
}

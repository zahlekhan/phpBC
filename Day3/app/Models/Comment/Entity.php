<?php

namespace App\Models\Comment;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;
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
 * @mixin Eloquent
 * @property-read \App\Models\Post\Entity $post
 */
class Entity extends Model
{
    use HasFactory;

    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'content',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User\Entity::class,"user_id","id");
    }

    public function post()
    {
        return $this->belongsTo(Post\Entity::class,"post_id","id");
    }
}

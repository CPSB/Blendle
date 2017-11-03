<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Tags\HasTags;

/**
 * Class NewsItems
 *
 * @package App
 */
class NewsItems extends Model
{
    use HasTags;

    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['author_id', 'name', 'publishDate', 'imagePath', 'status', 'message'];

    /**
     * Data relation for the author from the message.
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id')
            ->withDefault(['name', 'Unknown']);
    }
}

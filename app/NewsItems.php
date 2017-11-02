<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NewsItems
 *
 * @package App
 */
class NewsItems extends Model
{
    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['name', 'publishDate', 'status', 'message'];
}

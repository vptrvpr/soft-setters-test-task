<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Book
 *
 * @package App\Models
 * @property string $name
 * @property string $author_id
 * @property string $quantity_pages
 * @property string $date_of_issue
 * @property string $publisher
 * @property string $cover_type
 */
class Book extends Model
{
    /**
     * @var array
     */
    protected $dates = ['date_of_issue'];


    /**
     * Обратное отношение к автору
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo( Author::class );
    }


}

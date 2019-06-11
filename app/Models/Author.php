<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Author
 *
 * @package App\Models
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $country
 *
 */
class Author extends Model
{
    /**
     * Отношение к книгам
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books(){
        return $this->hasMany(Book::class,'author_id','id');
    }
}

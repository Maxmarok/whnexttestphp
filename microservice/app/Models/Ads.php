<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    /**
     * Лимит для пагинации
     * @var int
     */
    public const PAGE_LIMIT = 10;

    /**
     * Значение по умолчанию для типа сортировки
     * @var string
     */
    public const DEFAULT_TYPE= 'desc';

    /**
     * Значение по умолчанию для поля сортировки
     * @var string
     */
    public const DEFAULT_SORT = 'created_at';

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Показать все поля или только часть
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param bool $fields
     * @return void
     */
    public function scopeFields(Builder $query, bool $fields = false): void
    {
        $arr = ['id', 'title', 'price', 'photo'];

        if($fields) {
            $arr = array_merge($arr, ['photos', 'description']);
        }

        $query->select($arr);
    }
}

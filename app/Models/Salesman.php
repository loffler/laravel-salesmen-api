<?php

namespace App\Models;

use App\Traits\UUID;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Illuminate\Database\Query\Builder
 */
class Salesman extends Model
{
    use UUID;
    use HasFactory;

    protected $casts = [
        'titles_before' => 'array',
        'titles_after' => 'array',
    ];

    protected $fillable = ['first_name', 'last_name', 'titles_before', 'titles_after', 'prosight_id', 'email', 'phone', 'gender', 'marital_status'];

    public $sortable = ['first_name', 'last_name', 'created_at'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(DATE_ATOM);
    }
}

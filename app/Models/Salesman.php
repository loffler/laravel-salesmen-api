<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesman extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'title', 'prosight_id', 'email', 'phone', 'gender', 'marital_status'];
}

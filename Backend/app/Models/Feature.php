<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\GeneratesUuid;

class Feature extends Model
{
    use HasFactory, GeneratesUuid;
    protected $fillable = [
        'uuid',
        'user_id',
        'device',
        'value',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Place extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'type', 'city', 'description'];
}

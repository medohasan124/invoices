<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sections extends Model
{
    protected $fillable = [
        'name', 'description', 'addBy',
    ];
}

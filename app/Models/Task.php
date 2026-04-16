<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'username',
        'title',
        'description',
        'task_date',
        'file',
    ];
}

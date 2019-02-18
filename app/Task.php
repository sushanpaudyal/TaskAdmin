<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'description',
        'command',
        'expression',
        'dont_overlap',
        'run_in_maintenance',
        'notification_email'
    ];
}

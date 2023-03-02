<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'my_tasks';
    protected $primaryKey = 'my_id';
    public $incrementing = false;
    public $timestamps = false; // means do not create created_at and updated_at columns

    // set default values
    protected $attributes = [
        'name' => "Unset",
    ];
}

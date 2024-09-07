<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $table = 'schedules';

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}

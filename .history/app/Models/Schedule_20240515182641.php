<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedules';
    protected $fillable = [
        'user_id',
        'shift_id',
        'work_hours',
        'salary_amount',
    ];
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

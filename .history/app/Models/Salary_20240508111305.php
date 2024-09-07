<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{ use HasFactory;
    protected $table = 'salaries';
    protected $fillable = [
        'user_id',
        'month',
        'work_hours',
        'salary_amount',
        'salary_slip_url', // Assuming you have a field for the URL
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

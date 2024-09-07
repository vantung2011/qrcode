<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserScan extends Model
{
    protected $table = 'timesheets';
    use HasFactory;
    protected $fillable = ['user_id', 'check_in', 'check_out'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserScan extends Model
{
    $table = 'timesheets';
    use HasFactory;
    protected $fillable = ['user_id', 'scan_time', 'scan_type'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

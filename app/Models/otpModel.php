<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class otpModel extends Model
{
    use HasFactory;
    protected $table = 'otp_models';
    protected $fillable = ['user_id', 'otp', 'status'];
}

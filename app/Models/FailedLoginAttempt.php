<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedLoginAttempt extends Model
{
    protected $fillable = ['user_id', 'email_address', 'ip_address', 'created_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function record($email, $ip, $user = null)
    {
        return static::create([
            "user_id" => is_null($user) ? null : $user->id,
            "email_address" => $email,
            "ip_address" => $ip
        ]);
    }
}

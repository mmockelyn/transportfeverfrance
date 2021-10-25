<?php

namespace App\Models\Account;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDeviceToken extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public static function whereDeviceToken($device_token)
    {
        return self::query()->where('device_token');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

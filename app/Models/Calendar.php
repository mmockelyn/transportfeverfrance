<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $dates = ["created_at", "update_at", "start_date", "start_time", "end_date", "end_time"];
}

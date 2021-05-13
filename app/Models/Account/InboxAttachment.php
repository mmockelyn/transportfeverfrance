<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InboxAttachment extends Model
{
    protected $guarded = [];

    public function inbox()
    {
        return $this->belongsTo(Inbox::class);
    }
}

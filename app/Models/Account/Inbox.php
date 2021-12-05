<?php

namespace App\Models\Account;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at', 'read_at'];

    public function from()
    {
        return $this->belongsTo(User::class, 'from_id', 'id');
    }

    public function to()
    {
        return $this->belongsTo(User::class, 'to_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany(InboxAttachment::class);
    }

    public function next($id)
    {
        return Inbox::where('id', '>', $id)->orderBy('id', 'asc')->first();
    }

    public function previous($id)
    {
        return Inbox::where('id', '<', $id)->orderBy('id', 'desc')->first();
    }
}

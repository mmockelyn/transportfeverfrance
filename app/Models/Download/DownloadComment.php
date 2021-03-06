<?php

namespace App\Models\Download;

use App\Events\ModelCreated;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kalnoy\Nestedset\NodeTrait;

class DownloadComment extends Model
{
    use HasFactory, NodeTrait, Notifiable;

    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function download()
    {
        return $this->belongsTo(Download::class);
    }
}

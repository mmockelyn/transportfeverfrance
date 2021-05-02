<?php

namespace App\Models\Download;

use App\Events\ModelCreated;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kalnoy\Nestedset\NodeTrait;

class DownloadVersion extends Model
{
    use HasFactory, Notifiable, NodeTrait;

    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];

    protected $guarded = [];

    public function download()
    {
        return $this->belongsTo(Download::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

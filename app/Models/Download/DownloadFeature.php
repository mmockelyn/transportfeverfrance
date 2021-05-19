<?php

namespace App\Models\Download;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadFeature extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function download()
    {
        return $this->belongsTo(Download::class);
    }
}

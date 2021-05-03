<?php

namespace App\Models\Download;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadWiki extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function download()
    {
        return $this->belongsTo(Download::class);
    }
}

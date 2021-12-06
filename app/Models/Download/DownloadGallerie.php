<?php

namespace App\Models\Download;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadGallerie extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function download()
    {
        return $this->belongsTo(Download::class);
    }
}

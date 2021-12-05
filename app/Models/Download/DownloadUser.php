<?php

namespace App\Models\Download;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadUser extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'download_user';

    public function download()
    {
        return $this->belongsTo(Download::class);
    }
}

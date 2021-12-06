<?php

namespace App\Models\Download;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadSubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(DownloadCategory::class, 'download_category_id');
    }

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }
}

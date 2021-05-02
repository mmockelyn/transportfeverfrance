<?php

namespace App\Models\Download;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function subcategories()
    {
        return $this->hasMany(DownloadSubCategory::class);
    }
}

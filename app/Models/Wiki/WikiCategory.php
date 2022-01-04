<?php

namespace App\Models\Wiki;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WikiCategory extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function wikis()
    {
        return $this->hasMany(Wiki::class);
    }
}

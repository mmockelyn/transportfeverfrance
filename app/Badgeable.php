<?php


namespace App;


use App\Models\Core\Badge;

trait Badgeable
{
    public function badges()
    {
        return $this->belongsToMany(Badge::class);
    }
}

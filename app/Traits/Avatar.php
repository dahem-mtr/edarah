<?php
namespace App\Traits;
use App\Models\FIle;

trait avatar {
    public function avatar()
    {
        return $this->morphOne(FIle::class, 'fileable');
    }
}

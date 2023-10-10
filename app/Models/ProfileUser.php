<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileUser extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['address','user_id',];
    
    public function avatar()
    {
        return $this->morphOne(FIle::class, 'fileable');
    }

    public function user(){
    return $this->belongsTo(User::class);
}
}

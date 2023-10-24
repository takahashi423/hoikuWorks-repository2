<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class work extends Model
{

    public $timestamps = false;

    use HasFactory;

    public function user(){
        return $this->hasMany(User::class);
    }

    protected $fillable = [
        'title',
        'image_path',
        'material',
        'season_id',
    ];

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    
}

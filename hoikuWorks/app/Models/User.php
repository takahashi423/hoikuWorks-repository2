<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    public $timestamps = false; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function works(){
        return $this->hasMany(Work::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Work::class, 'likes', 'user_id', 'work_id');
    }


    // このメソッド内でいいねのトグル処理を実装
    public function toggleLike(Work $work)
    {
        if ($this->likes->contains($work)) {
            // すでにいいね済みの場合、いいねを削除
            $this->likes()->detach($work);
        } else {
            // いいねしていない場合、いいねを追加
            $this->likes()->attach($work);
        }
    }
}

?>

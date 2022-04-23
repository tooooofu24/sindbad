<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'uid', 'icon_url'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function blockUsers()
    {
        return $this->belongsToMany(User::class, 'blocks', 'user_id', 'block_id');
    }

    public function getBlockUserIdListAttribute($value)
    {
        return $this->blockUsers->pluck('id');
    }

    /**
     * 
     * @param mixed $value
     * 
     * @return string
     */
    public function getIconUrlAttribute($value): string
    {
        if (!$value) {
            return asset('img/icon-gray.jpg');
        }
        if (substr($value, 0, 8) == "https://") {
            return $value;
        }
        return env('AWS_BASE_URL') . $value;
    }

    public function isAdmin()
    {
        return false;
    }

    public function isUser()
    {
        return true;
    }

    public static function boot()
    {
        parent::boot();
        // 登録時に初期値を入れる
        self::creating(function (self $user) {
            // ユニークなIDを作成
            $user->uid = Str::uuid();
            // 名前の初期値
            if (!$user->name) {
                $user->name = 'ユーザー';
            }
        });
        self::updating(function (self $user) {
            if ($user->isDirty('email')) {
                $user->sendEmailVerificationNotification();
            }
            // パスワードが変わった場合
            $user->password = Hash::make($user->password);
        });
        self::deleted(function (self $user) {
            if ($user->icon_url)
                Storage::disk('s3')->delete($user->icon_url);
        });
    }
}

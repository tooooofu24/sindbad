<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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

    /**
     * 
     * @param mixed $value
     * 
     * @return string
     */
    public function getIconUrlAttribute($value): string
    {
        if (!$value) {
            return '';
        }
        return env('AWS_BASE_URL') . $value;
    }

    public static function boot()
    {
        parent::boot();
        // 登録時に初期値を入れる
        self::creating(function (self $user) {
            // ユニークなIDを作成
            $user->uid = Str::uuid();
        });
        self::updating(function (self $user) {
            if ($user->isDirty('email')) {
                $user->sendEmailVerificationNotification();
            }
            // パスワードが変わった場�
                $user->password = Hash::make($user->password);
        });
        self::deleted(function (self $user) {
            if ($user->icon_url)
                Storage::disk('s3')->delete($user->icon_url);
        });
    }
}

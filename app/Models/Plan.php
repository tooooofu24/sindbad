<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'thumbnail_url',
        'start_date_time',
        'public_flag',
    ];

    protected $casts = [
        'start_date_time' => 'datetime'
    ];

    /**
     * サムネイルURLが存在しない場合、子要素のサムネイルを使う
     * 
     * @param mixed $value
     * 
     * @return string
     */
    public function getThumbnailUrlAttribute($value): string
    {
        if ($value) {
            return '';
        }
        $thumbnail_url = '';
        foreach ($this->planElements as $planElement) {
            if ($thumbnail_url = optional($planElement->spot)->thumbnail_url) {
                break;
            }
        }
        return $thumbnail_url;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function planElements()
    {
        return $this->hasMany(PlanElement::class);
    }

    public static function boot()
    {
        parent::boot();
        // 登録時に初期値を入れる
        self::creating(function (self $plan) {
            $uid = Str::random(30);
            // 重複チェック
            while (self::where('uid', $uid)->exists()) {
                $uid = Str::random(30);
            }
            $plan->uid = $uid;
        });
        // 更新時と削除時に子要素を削除
        self::updating(function (self $plan) {
            foreach ($plan->planElements as $planElement) {
                $planElement->delete();
            }
        });
        self::deleting(function (self $plan) {
            foreach ($plan->planElements as $planElement) {
                $planElement->delete();
            }
            foreach ($plan->favorites as $favorite) {
                $favorite->delete();
            }
        });
    }
}

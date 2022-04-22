<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'thumbnail_url',
        'start_date_time',
        'public_flag',
        'is_editing',
        'parent_id',
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
            return env('AWS_BASE_URL') . $value;
        }
        $thumbnail_url = '';
        foreach ($this->planElements as $planElement) {
            if ($thumbnail_url = optional($planElement->spot)->thumbnail_url) {
                break;
            }
        }
        if (!$thumbnail_url)
            $thumbnail_url = asset('img/icon-gray.jpg');
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

    public function parentPlan()
    {
        return $this->belongsTo(Plan::class, 'parent_id');
    }

    public function deleteElements()
    {
        foreach ($this->planElements as $planElement) {
            $planElement->delete();
        }
    }

    public function getUrlAttribute()
    {
        if ($this->user_id == Auth::id() && !$this->public_flag) {
            return route('plans.show', ['id' => $this->id, 'uid' => $this->uid]);
        }
        return route('plans.show', ['id' => $this->id]);
    }

    public function getIsLikedAttribute()
    {
        if (request()->user()->isAdmin()) {
            return false;
        }
        return in_array($this->id, request()->user()->favorites->pluck('plan_id')->toArray());
    }

    public function scopeWithAllRelations($query)
    {
        $query->with([
            'user', 'planElements.spot', 'planElements.transportation', 'parentPlan.user'
        ])
            ->withCount(['favorites']);
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
        self::deleting(function (self $plan) {
            $plan->deleteElements();
            foreach ($plan->favorites as $favorite) {
                $favorite->delete();
            }
            if ($plan->thumbnail_url)
                Storage::disk('s3')->delete($plan->thumbnail_url);
        });
    }
}

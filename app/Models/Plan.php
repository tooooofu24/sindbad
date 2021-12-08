<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Plan extends Model
{
    use HasFactory;
    function __construct($attributes = [])
    {
        $uid = Str::random(25);
        // 重複チェック
        while (self::where('uid', $uid)->exists()) {
            $uid = Str::random(25);
        }
        $this->uid = $uid;
        parent::__construct($attributes);
    }

    protected $fillable = [
        'title',
        'thumbnail_url',
        'start_date_time',
        'public_flag',
    ];

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
    /**
     * 小要素のplan_elementsを全て削除するメソッド
     * @return void
     */
    public function deletePlanElements(): void
    {
        foreach ($this->planElements as $planElement) {
            $planElement->delete();
        }
    }
}

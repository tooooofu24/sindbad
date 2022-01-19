<?php

namespace App\Models;

use App\Service\ModerateService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'converted_name', 'thumbnail_url', 'pref', 'status'
    ];

    public function planElements()
    {
        return $this->hasMany(PlanElement::class, 'child_id')->where('type', 1);
    }

    public static function boot()
    {
        parent::boot();
        // 登録時に初期値を入れる
        self::creating(function (self $spot) {
            if (!ModerateService::moderate($spot->name)) {
                $spot->status = -10;
            }
        });
    }
}

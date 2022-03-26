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
        'name', 'converted_name', 'thumbnail_url', 'pref', 'status', 'count'
    ];

    public function planElements()
    {
        return $this->hasMany(PlanElement::class, 'child_id')->where('type', 1);
    }

    public function getThumbnailUrlAttribute($value): string
    {
        if (!$value) {
            return asset('img/icon-gray.jpg');
        }
        return $value;
    }

    /**
     * 検索ワードで絞り込むメソッド
     * 検索文字列が空欄などを含まない場合は検索結果をマッチ率でソートする
     * 
     * @param mixed $query
     * @param mixed $q 検索文字列
     * 
     * @return [type]
     */
    public function scopeOfSearch($query, $q)
    {
        $words = preg_split('/[\s|\x{3000}]+/u', $q);
        foreach ($words as $word) {
            $query->where(function ($query) use ($word) {
                $query->orWhere('name', 'like', "%$word%")
                    ->orWhere('converted_name', 'like', "%$word%");
            });
        }
        if (count($words) == 1) {
            $query->selectRaw(
                "*, 
                (CASE 
                WHEN name = \"$q\" THEN 100 + count
                WHEN name like \"$q%\" THEN 80 + count 
                WHEN name like \"%$q%\" THEN 30 + count 
                ELSE 0 + count 
                END) 
                AS match_count"
            );
            return $query->orderBy('match_count', 'DESC');
        }
        return $query;
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

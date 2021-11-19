<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanElement extends Model
{
    use HasFactory;

    protected $table = 'plan_elements';
    protected $fillable = [
        'child_id', 'memo', 'type', 'duration_min'
    ];

    public function child() // 0 => blank, 1 => spot, 2 => transportation
    {
        if ($this->type == 0) {
            return null;
        } elseif ($this->type == 1) {
            return $this->belongsTo(Spot::class, 'child_id');
        } else {
            return $this->belongsTo(Transportation::class, 'child_id');
        }
    }

    public static function createFromRequest(array $dataArray, int $plan_id): void
    {
        foreach ($dataArray as $data) {
            $planElement = new PlanElement();
            $planElement->fill($data);
            $planElement->plan_id = $plan_id;
            $planElement->save();
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanElement extends Model
{
    use HasFactory;

    protected $table = 'plan_elements';
    protected $fillable = [
        'child_id',
        'memo',
        'type', // 0 => blank, 1 => spot, 2 => transportation
        'duration_min',
        'plan_id'
    ];

    public function spot()
    {
        return $this->belongsTo(Spot::class, 'child_id');
    }

    public function transportation()
    {
        return $this->belongsTo(Transportation::class, 'child_id');
    }

    public function getStartDateTimeAttribute()
    {
        $start_date_time = $this->plan->start_date_time;
        foreach ($this->plan->planElements as $planElement) {
            if ($planElement->id == $this->id) {
                break;
            }
            $start_date_time->addMinutes($planElement->duration_min);
        }
        return $start_date_time;
    }

    public function getEndDateTimeAttribute()
    {
        return $this->start_date_time->addMinutes($this->duration_min);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanElement extends Model
{
    use HasFactory;

    protected $table = 'plan_elements';
    protected $fillable = [
        'plan_id', 'spot_id', 'memo', 'transportation_id', 'type',
    ];
    public function spot()
    {
        return $this->belongsTo(Spot::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'converted_name	', 'thumbnail_url', 'pref',
    ];

    public function count()
    {
        $count = PlanElement::where('type', 1)
            ->where('child_id', $this->id)
            ->count();
        return $count;
    }
}
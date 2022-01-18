<?php

namespace App\Models;

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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spot extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'converted_name	',
        'thumbnail_url',
        'pref',
        'spot_type_id',
    ];

    public function pref()
    {
        return $this->belongsTo(Pref::class);
    }

    public function spot_type()
    {
        return $this->belongsTo(Spot_type::class);
    }
}

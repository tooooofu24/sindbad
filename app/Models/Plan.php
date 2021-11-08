<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Util\Json;
use Psy\Util\Json as UtilJson;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'thumbnail_url',
        'start_date_time',
        'public_flag',
        'prefs'
    ];

    protected $casts = ['prefs' => 'json'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }
}

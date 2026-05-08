<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'image_url',
        'status',
        'latitude',
        'longitude',
    ];

    // RELASI KE USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
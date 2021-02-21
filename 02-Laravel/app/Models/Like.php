<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image_id',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function image() {
        return $this->belongsTo('App\Image');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'to', 'from', 'range'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

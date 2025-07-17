<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}

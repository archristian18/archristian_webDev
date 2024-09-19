<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'company', 'email', 'phone'];

    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


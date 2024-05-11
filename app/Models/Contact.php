<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['fullname'];

    public function phones()
    {
        return $this->hasMany(ContactPhone::class);
    }

    public function addresses()
    {
        return $this->hasMany(ContactAddress::class);
    }

    public function emails()
    {
        return $this->hasMany(ContactEmail::class);
    }
}

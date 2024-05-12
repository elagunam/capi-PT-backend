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
        return $this->hasMany(ContactPhone::class)->where('deleted', 0);
    }

    public function addresses()
    {
        return $this->hasMany(ContactAddress::class)->where('deleted', 0);
    }

    public function emails()
    {
        return $this->hasMany(ContactEmail::class)->where('deleted', 0);
    }
}

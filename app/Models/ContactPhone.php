<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPhone extends Model
{
    use HasFactory;

    protected $fillable = ['contact_id', 'phone_number', 'type'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}

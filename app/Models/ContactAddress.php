<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactAddress extends Model
{
    use HasFactory;

    protected $fillable = ['contact_id', 'address', 'city', 'country', 'zip'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}

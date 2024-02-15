<?php

namespace Thtocha\ContactsPackage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    use HasFactory;

    protected $fillable = ['phone_number'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}

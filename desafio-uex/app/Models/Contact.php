<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ["name", "cpf", "phone", "email", "address_id", "user_id"];

    public function address(){

        return $this->belongsTo(Address::class);
    }
}

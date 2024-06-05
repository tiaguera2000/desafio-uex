<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ["state", "city", "district", "zip_code", "street", "number", "complement", "lat", "lon"];
    
    public function contact(){

        return $this->hasOne(Contact::class);
    }
    
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends BaseModel
{
    protected $fillable = [
        'title','name','surname','middle_name','maiden_name', 'email','landline','gender','national_id_number','date_of_birth','marital_status','name_of_company','postal_address','residential_address','cell_number'
    ];

    public function policy(){
        return $this->hasMany(Policy::class);
    }

    public function banking_details(){
        return $this->hasOne(BankDetail::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends BaseModel
{
    //
    protected $fillable = ['bank_name','bank_account_number','bank_branch','client_id'];

    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }
}

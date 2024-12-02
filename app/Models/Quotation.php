<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    //
    protected $table = 'quotations'; 

    protected $fillable = [
        'ClientName',
        // 'Organisation',
        // 'ClientEmail',
        // 'ClientPhone',
        'ClientAddress'
    ];

    public function user(){

        return $this-> belongsTo(User::class);
    }
}


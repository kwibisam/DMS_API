<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    //
    protected $table = 'quotations'; 

    protected $fillable = [
        'name',
        'service',
        'price'
    ];
}
<?php

namespace App\Models\Facturar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centimo extends Model
{
    use HasFactory;
    protected $table="centimo";
    protected $fillable=[
        'centimo','abreviatura'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $fillable =[
        'nama','kapasitas','lokasi','deskripsi','foto'
    ];
}

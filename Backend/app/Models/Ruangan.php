<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $fillable =[
        'nama_ruangan','kapasitas','lokasi','deskripsi','foto'
    ];
}

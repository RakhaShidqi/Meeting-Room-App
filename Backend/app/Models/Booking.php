<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable =[
        'ruangan_id',
        'nama_pemesan',
        'divisi',
        'event',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'status',
    ];
}

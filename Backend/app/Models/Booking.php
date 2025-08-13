<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable =[
        'ruangan_id',
        'nama_pemesan',
        'divisi',
        'event',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'status'
    ];
    // Default value untuk status
    protected $attributes = [
        'status' => 'Waiting Approval'
    ];
}

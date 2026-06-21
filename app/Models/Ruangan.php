<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ruangan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_ruangan',
        'kapasitas',
        'fasilitas',
        'status_ketersediaan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status_ketersediaan' => 'boolean',
    ];

    /**
     * Get the details of the submissions associated with the room.
     */
    public function detailPengajuans()
    {
        return $this->hasMany(DetailPengajuan::class, 'id_ruangan');
    }

    /**
     * Get the schedules associated with the room.
     */
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'id_ruangan');
    }
}

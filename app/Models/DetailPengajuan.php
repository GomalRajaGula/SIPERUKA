<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_pengajuan
 * @property int $id_ruangan
 * @property string $tanggal_kegiatan
 * @property string $waktu_mulai
 * @property string $waktu_selesai
 * @property \App\Models\Pengajuan $pengajuan
 * @property \App\Models\Ruangan $ruangan
 */
class DetailPengajuan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detail_pengajuan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_pengajuan',
        'id_ruangan',
        'tanggal_kegiatan',
        'waktu_mulai',
        'waktu_selesai',
    ];

    /**
     * Get the submission associated with this detail.
     */
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'id_pengajuan');
    }

    /**
     * Get the room associated with this detail.
     */
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }
}

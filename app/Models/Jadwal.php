<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_pengajuan
 * @property int $id_ruangan
 * @property string $tanggal_kegiatan
 * @property string $status_kegiatan
 * @property \App\Models\Pengajuan $pengajuan
 * @property \App\Models\Ruangan $ruangan
 */
class Jadwal extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jadwal';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_pengajuan',
        'id_ruangan',
        'tanggal_kegiatan',
        'status_kegiatan',
    ];

    /**
     * Get the submission associated with this schedule.
     */
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'id_pengajuan');
    }

    /**
     * Get the room associated with this schedule.
     */
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }
}

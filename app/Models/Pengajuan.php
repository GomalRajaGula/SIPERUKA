<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengajuan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'file_dokumen_pendukung',
        'status',
        'kode_tte',
    ];

    /**
     * Get the user who submitted the request.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Get the details of the request.
     */
    public function detailPengajuans()
    {
        return $this->hasMany(DetailPengajuan::class, 'id_pengajuan');
    }

    /**
     * Get the schedules generated from this request.
     */
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'id_pengajuan');
    }
}

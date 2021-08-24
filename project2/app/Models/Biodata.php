<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prov;
use App\Models\Kabkota;
use App\Models\Kec;

class Biodata extends Model
{
    use HasFactory;
    protected $fillable = ['nama_lengkap', 'avatar', 'prov_id' ,'kabkota_id', 'kec_id'];

    public function prov()
    {
        return $this->belongsTo(Prov::class);
    }

    public function kabkota()
    {
        return $this->belongsTo(Kabkota::class);
    }

    public function kec()
    {
        return $this->belongsTo(Kec::class);
    }
}

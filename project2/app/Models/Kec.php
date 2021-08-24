<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kabkota;
use App\Models\Biodata;

class Kec extends Model
{
    use HasFactory;
    protected $table = ('kec');
    protected $fillable = ['nama_kec', 'kabkota_id'];

    public function kabkota()
    {
        return $this->belongsTo(Kabkota::class);
    }

    public function biodata()
    {
        return $this->hasMany(Biodata::class);
    }
}

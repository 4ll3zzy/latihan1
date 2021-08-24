<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prov;
use App\Models\Kec;
use App\Models\Biodata;

class Kabkota extends Model
{
    use HasFactory;
    protected $table = ('kabkota');
    protected $fillable = ['nama_kabkota', 'prov_id'];

    public function kec()
    {
        return $this->hasMany(Kec::class);
    }

    public function prov()
    {
        return $this->belongsTo(Prov::class);
    }

    public function biodata()
    {
        return $this->hasMany(Biodata::class);
    }
}

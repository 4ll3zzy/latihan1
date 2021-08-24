<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kabkota;
use App\Models\Biodata;

class Prov extends Model
{
    use HasFactory;
    protected $table = ('prov');
    protected $fillable = ['nama_prov'];

    public function kabkota()
    {
        return $this->hasMany(Kabkota::class);
    }

    public function biodata()
    {
        return $this->hasMany(Biodata::class);
    }
}

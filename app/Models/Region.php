<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Region extends Model
{
    public $table = 'regions';
    public $timestamps = false;

    protected $dates = [];

    protected $fillable = [
        'denj',
        'fsj',
        'mnemonic',
        'zona',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function regionPlaces()
    {
        return $this->hasMany(Place::class, 'region_id', 'id');
    }

    public function regionCertificates()
    {
        return $this->hasMany(Certificate::class, 'region_id', 'id');
    }

    public function regionProfiles()
    {
        return $this->hasMany(Profile::class, 'region_id', 'id');
    }

    public function regionProducts()
    {
        return $this->hasMany(Product::class, 'region_id', 'id');
    }
}
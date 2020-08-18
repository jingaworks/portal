<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Place extends Model
{
    public $table = 'places';
    public $timestamps = false;

    protected $dates = [];

    protected $fillable = [
        'denloc',
        'codp',
        'sirsup',
        'tip',
        'zona',
        'niv',
        'med',
        'regiune',
        'fsj',
        'fs_2',
        'fs_3',
        'fsl',
        'rang',
        'fictiv',
        'region_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function placeCertificates()
    {
        return $this->hasMany(Certificate::class, 'place_id', 'id');
    }

    public function placeProfiles()
    {
        return $this->hasMany(Profile::class, 'place_id', 'id');
    }

    public function placeProducts()
    {
        return $this->hasMany(Product::class, 'place_id', 'id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
}

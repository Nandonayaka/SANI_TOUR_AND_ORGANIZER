<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = ['name', 'description', 'image'];

    public function tourPackages()
    {
        return $this->hasMany(TourPackage::class);
    }
}

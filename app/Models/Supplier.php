<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminte\Contracts\Queue\ShouldQueue;

class Supplier extends Model {

    use HasFactory;

    protected $fillable = ['name', 'address_1', 'address_2', 'city', 'county', 'postcode', 'telephone', 'fax', 'email', 'url', 'photo_id', 'notes'];

    public function email(): Attribute
    {
        return new Attribute(
            fn($value) => ucfirst($value),
            fn($value) => strtolower($value),
        );
    }

    public function address_1(): Attribute
    {
        return new Attribute(
            fn($value) => ucfirst($value),
            fn($value) => strtolower($value),
        );
    }

    public function address_2(): Attribute
    {
        return new Attribute(
            fn($value) => ucfirst($value),
            fn($value) => strtolower($value),
        );
    }

    public function city(): Attribute
    {
        return new Attribute(
            fn($value) => ucfirst($value),
            fn($value) => strtolower($value),
        );
    }

    public function county(): Attribute
    {
        return new Attribute(
            fn($value) => ucfirst($value),
            fn($value) => strtolower($value),
        );
    }

    public function postcode(): Attribute
    {
        return new Attribute(
            fn($value) => ucwords($value),
            fn($value) => strtolower($value),
        );
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);

    }

    public function miscellanea()
    {
        return $this->hasMany(Miscellanea::class);
    }

    public function component()
    {
        return $this->hasMany(Component::class);

    }

    public function accessory()
    {
        return $this->hasMany(Accessory::class);

    }

    public function software()
    {
        return $this->hasMany(Software::class);

    }

    public function broadband()
    {
        return $this->hasMany(Broadband::class);

    }

    public function consumable()
    {
        return $this->hasMany(Consumable::class);

    }

}

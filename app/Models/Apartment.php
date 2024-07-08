<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'title', 'slug', 'description', 'number_of_rooms', 'number_of_beds', 'number_of_bathrooms', 'square_meters', 'address', 'image', 'lat', 'long', 'visibility'];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function sponsorships()
    {
        return $this->belongsToMany(Sponsorship::class)->withPivot('start_time', 'end_time');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

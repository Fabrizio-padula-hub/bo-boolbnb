<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Message;
use App\Models\Visit;
use App\Models\Sponsorship;
use App\Models\Service;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'slug', 'description', 'number_of_rooms', 'number_of_beds', 'number_of_bathrooms', 'square_meters', 'address', 'visibility'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }

    public function visit()
    {
        return $this->hasMany(Visit::class);
    }

    public function sponsorship()
    {
        return $this->belongsToMany(Sponsorship::class);
    }

    public function service()
    {
        return $this->belongsToMany(Service::class);
    }
}

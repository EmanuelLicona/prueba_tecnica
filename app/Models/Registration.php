<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    public function parentRegistration()
    {
        return $this->belongsTo(Registration::class, 'parent_registration_id', 'id');
    }

    public function childrenRegistrations()
    {
        return $this->hasMany(Registration::class, 'parent_registration_id', 'id');
    }

    public function getAge()
    {
        $birthday = Carbon::createFromFormat('Y-m-d', $this->fecha_nacimiento);
        $currentDate = Carbon::now();

        return $currentDate->diffInYears($birthday);
    }
}

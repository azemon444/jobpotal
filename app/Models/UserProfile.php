<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'full_name', 'address', 'phone', 'dob', 'gender', 'nationality', 'about', 'profile_pic',
        'cv', 'education', 'experience', 'skills', 'references'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

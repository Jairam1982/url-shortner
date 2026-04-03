<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Urls extends Model
{
    protected $fillable = [
        'short_url',
        'long_url',
        'company_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }    
}

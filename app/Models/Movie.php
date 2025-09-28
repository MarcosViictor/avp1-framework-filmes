<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $primaryKey = 'id_movie';
    
    protected $fillable = ['title','director','year','rating','watched','description', 'user_id'];

    public function getRouteKeyName()
    {
        return 'id_movie';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

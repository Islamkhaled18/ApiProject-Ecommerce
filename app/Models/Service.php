<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;


    protected $guarded =[];

    protected $table = 'services';

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

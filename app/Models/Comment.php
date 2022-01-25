<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded =[];

    protected $table ="comments";

    public function service()
    {
        return $this->belongsTo(Service::class ,'service_id');
    }
}

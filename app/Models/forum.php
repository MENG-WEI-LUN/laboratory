<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class forum extends Model
{
    protected $table = 'forum';
    protected $fillable = ['title','context'];
}

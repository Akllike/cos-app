<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muse extends Model
{
    use HasFactory;
    protected $table = 'muses';
    protected $guarded = [];
}

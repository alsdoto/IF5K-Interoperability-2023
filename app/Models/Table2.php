<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table2 extends Model
{
    protected $table = 'table2';

    protected $fillable = ['id', 'nama', 'umur'];
}

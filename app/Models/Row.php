<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string  $name
 * @property string  $date
 */
class Row extends Model
{
    protected $table   = "rows";

    public $timestamps = false;
}

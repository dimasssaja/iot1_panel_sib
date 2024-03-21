<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamp extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['data_json'];

    public function getDataJsonAttribute($value)
    {
        return json_decode($this->data);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExMedRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'epro_id','material_code','version','amount','remarks','approve_status','status','created_at','updated_at'
    ];

}

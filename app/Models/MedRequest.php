<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'pro_id','product_name','version','amount','remarks','approve_status','status','created_at','updated_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rm_cost extends Model
{
    use HasFactory;

    protected $fillable = ['version','b_id','Product_id', 'Product_name', 'Ingredient','scrap', 'rate', 'qty','status','scrap_user','p_scrap_approval','sapcode','purchase_user','rm_user','inscrap','mcost'];
    protected $table = 'rm_costs';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Material extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id','version','material','product_details','specification','quantity','MOQ','vendor','basic',
        'freight','scrap','pm_cost','package_user','uom','pm_user','pm_date','scrap_user','package_date'

    ];
}

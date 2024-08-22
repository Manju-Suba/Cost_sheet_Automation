<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class existing_product extends Model
{
    use HasFactory;
    protected $fillable = [
        'epro_id','material_code','pieces_per_case','noofpcs_approval','mrp_piece','status','mt_exsheet_approval','excsheet_approval','marketuser','salesTax','hsnCode','tax_approval','taxuser','taxdate','division'
        // ,'primary_freight','secondary_freight','freight_approval',
        // 'damage','logistic',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basic extends Model
{
    use HasFactory;
    protected $fillable = [
        'pro_id','Product_name','distribution_value','Volume','uom','case_configuration','quantity','mrp_price','from_location','to_location','retailer_margin','primary_scheme','rs_margin','ss_margin','bf_product_approval','specific_gravity','total_rm_cost','conv_cost','conv_uom','breakup_excel','bf_ingic_approval','hsnCode','salesTax','tax_approval','primary_freight','secondary_freight','bf_freight_approval','damage','logistic','status','product_status','version'
        ,'b_quantity_approval','b_mrp_price_approval','b_retailer_margin_approval', 'b_primary_scheme_approval','b_rs_margin_approval',
        'b_ss_margin_approval',
        'b_conv_cost_approval',
        'b_salesTax_approval','b_volume_approval','b_case_approval',
        'b_damage_approval',
        'b_logistic_approval','plant','marketuser','tax_user','tax_date','logistic_user',
        'logistic_date','convo_user','convo_date','fg_scrap','fg_scrap_approval','fg_scrap_user','division'
    ];
}

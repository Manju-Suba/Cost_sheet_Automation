<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperationController extends Controller
{

    public function getIngredient()
    {
        $data = DB::table('rm_costs')
        ->select('rm_costs.id','rm_costs.rate','rm_costs.cost','rm_costs.Ingredient','rm_costs.scrap','basics.Product_name')
        ->join('basics', 'rm_costs.Product_id', '=', 'basics.pro_id')
        ->where('basics.status', '3')
        ->get();
        $table = array();
        $i = 1;
        foreach ($data as $row) {
        $table1 = array();
        $table1['Ingredients'] = $row->Ingredient;
        $table1['rate'] = $row->rate;
        $table1['cost'] = $row->cost;
        if($row->scrap != null ||$row->scrap == 0 ){
            $table1['Scrap'] = '<input type="text" class="form-control input-xs" id="id_scrap" name="scrap_name" value="'.$row->scrap.'" >';
            $table1['Action']='<button type="button" class="btn btn-primary btn-sm scrapclass" data-id="' . $row->id . '" id="scrap_add">Update</button>';
        }else{
            $table1['Scrap'] = '<input type="text" class="form-control input-xs" id="id_scrap" name="scrap_name" value="" >';
            $table1['Action']='<button type="button" class="btn btn-primary btn-sm scrapclass" data-id="' . $row->id . '" id="scrap_add">Add Scrap</button>';
        }

        $table[] = $table1;
        $i++;
        }
        $response = array(
        "data" => $table
        );
        echo json_encode($response);
    }
}

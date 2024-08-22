<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Billing;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\LogisticController;
use App\Http\Controllers\FinnanceController;
use App\Http\Controllers\MEDController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

//LOGIN
Route::get('login',[LoginController::class,'loginpage'])->middleware('guest')->name('login');
Route::post('authenticate',[LoginController::class,'authenticate']);
Route::get('logout',[LoginController::class,'logout'])->name('logout');
Route::view('register','auth.register')->middleware('guest');

//PAGE CALLING
Route::middleware('auth')->group(function () {
Route::get('market',[AdminController::class,'market'])->name('market');
Route::get('dashBoardData',[AdminController::class,'dashBoardData'])->name('dashBoardData');
Route::get('epdDashboardData',[AdminController::class,'epdDashboardData'])->name('epdDashboardData');

Route::get('dash',[AdminController::class,'dashboard'])->name('dash');
Route::get('epdproducts',[AdminController::class,'epdproducts'])->name('epdproducts');
Route::get('purchase',[AdminController::class,'purchase'])->name('purchase');
Route::get('epd_specific_gravity',[AdminController::class,'epd_specific_gravity'])->name('epd_specific_gravity');
Route::get('pmpurchase',[AdminController::class,'pmpurchase'])->name('pmpurchase');
Route::get('oprations',[AdminController::class,'oprations'])->name('oprations');
Route::get('formulation',[AdminController::class,'formulation'])->name('formulation');
Route::get('taxation',[AdminController::class,'taxation'])->name('taxation');
Route::get('packing',[AdminController::class,'packing'])->name('packing');
Route::get('Logistic',[AdminController::class,'Logistic'])->name('Logistic');
Route::get('LogisticSub',[AdminController::class,'LogisticSub'])->name('LogisticSub');
Route::get('epd_damage',[AdminController::class,'epd_damage'])->name('epd_damage');
Route::get('product_approval',[AdminController::class,'product_approval'])->name('product_approval');
Route::get('rm_cost_approval',[AdminController::class,'rm_cost_approval'])->name('rm_cost_approval');
Route::get('pm_cost_approval',[AdminController::class,'pm_cost_approval'])->name('pm_cost_approval');
Route::get('rm_scrap_approval',[AdminController::class,'rm_scrap_approval'])->name('rm_scrap_approval');
Route::get('pm_scrap_approval',[AdminController::class,'pm_scrap_approval'])->name('pm_scrap_approval');
Route::get('conversion_cost_approval',[AdminController::class,'conversion_cost_approval'])->name('conversion_cost_approval');
Route::get('epd_pm_rate_verified',[AdminController::class,'epd_pm_rate_verified'])->name('epd_pm_rate_verified_page');
Route::get('epd_rm_rate_verified',[AdminController::class,'epd_rm_rate_verified'])->name('epd_rm_rate_verified_page');

Route::get('ingic_approval',[AdminController::class,'ingic_approval'])->name('ingic_approval');
Route::get('tax_approval',[AdminController::class,'tax_approval'])->name('tax_approval');
Route::get('pfreight_approval',[AdminController::class,'pfreight_approval'])->name('pfreight_approval');
Route::get('rmrate',[AdminController::class,'rmview'])->name('rmrate');
Route::get('pmbom',[AdminController::class,'pmview']);
Route::get('uom',[AdminController::class,'uom'])->name('uom');
Route::get('costsheet',[AdminController::class,'costsheet']);
Route::get('costsheet_approval',[AdminController::class,'costsheet_approval'])->name('costsheet_approval');
Route::get('epd_costsheet_approval',[AdminController::class,'epd_costsheet_approval'])->name('epd_costsheet_approval');
Route::get('epd_cs_approve_mt',[AdminController::class,'epd_cs_approve_mt'])->name('epd_cs_approve_mt');


Route::get('npd_cost_sheet',[AdminController::class,'npd_cost_sheet']);
Route::get('epd_cost_sheet',[AdminController::class,'epd_cost_sheet'])->name('epd_cost_sheet');
Route::get('distribution_channel',[AdminController::class,'distribution_channel'])->name('distribution_channel');


Route::get('extax_approval',[AdminController::class,'extax_approval'])->name('extax_approval');
Route::get('exfreight_approval',[AdminController::class,'exfreight_approval'])->name('exfreight_approval');
Route::get('epd_logistic',[AdminController::class,'epd_logistic']);
Route::get('epd_sec_logistic',[AdminController::class,'epd_sec_logistic']);
Route::get('location_master',[AdminController::class,'location_master']);


Route::get('approved_cost_sheets',[AdminController::class,'approved_cost_sheets'])->name('approved_cost_sheets');
Route::get('med_request_approval',[AdminController::class,'med_request_approval'])->name('med_request_approval');
Route::get('exmed_request_approval',[AdminController::class,'exmed_request_approval'])->name('exmed_request_approval');
Route::get('med_request',[AdminController::class,'med_request'])->name('med_request');
Route::get('plant_master',[AdminController::class,'plant_master'])->name('plant_master');
Route::get('division',[AdminController::class,'division'])->name('division');


Route::get('textnew',function(){
    return view('layout.new');
});

//MARKET TEAM
 
Route::post('exist_save',[MarketingController::class,'exist_save']);
Route::post('view_remarks',[MarketingController::class,'view_remarks']);

Route::post('savemarket',[MarketingController::class,'save']);
Route::get('show', [MarketingController::class,'show']);
Route::get('location', [AdminController::class,'location'])->name('location');
Route::get('show_rejected', [MarketingController::class,'show_rejected']);
Route::get('show_approved', [MarketingController::class,'show_approved']);
Route::get('exists_product', [MarketingController::class,'exists_product']);
Route::get('exists_approved', [MarketingController::class,'exists_approved']);
Route::get('exists_rejected', [MarketingController::class,'exists_rejected']);
Route::post('add_uom',[MarketingController::class,'save_uom']);
Route::get('fetch_uom',[MarketingController::class,'fetch_uom']);


Route::get('get_uom/{id}',[MarketingController::class,'get_uom']);
Route::get('delete_uom/{id}',[MarketingController::class,'delete_uom']);
Route::post('update_uom',[MarketingController::class,'update_uom']);
Route::post('add_location',[MarketingController::class,'save_location']);
Route::get('fetch_location_master',[MarketingController::class,'fetch_location_master']);
Route::get('get_location/{id}',[MarketingController::class,'get_location']);
Route::get('delete_location/{id}',[MarketingController::class,'delete_location']);
Route::post('update_location',[MarketingController::class,'update_location']);
Route::post('add_dist_ch',[MarketingController::class,'save_dist_ch']);
Route::get('fetch_dist_ch',[MarketingController::class,'fetch_dist_ch']);
Route::get('get_dist_ch/{id}',[MarketingController::class,'get_dist_ch']);
Route::get('delete_dist_ch/{id}',[MarketingController::class,'delete_dist_ch']);
Route::post('update_dist_ch',[MarketingController::class,'update_dist_ch']);
Route::get('delete_basic',[MarketingController::class,'delete_basic']);
Route::get('edit_details',[MarketingController::class,'edit_details']);
Route::get('edit_epddetails',[MarketingController::class,'edit_epddetails']);
Route::post('update_details',[MarketingController::class,'update_details']);
Route::post('update_exist_details',[MarketingController::class,'update_exist_details']);
Route::get('delete_ex',[MarketingController::class,'delete_ex']);
Route::post('saveDivision',[MarketingController::class,'saveDivision']);
Route::get('fetchDivision',[MarketingController::class,'fetchDivision']);
Route::get('findDivision/{id}',[MarketingController::class,'findDivision']);
Route::get('deleteDivision/{id}',[MarketingController::class,'deleteDivision']);
Route::post('updateDivision',[MarketingController::class,'updateDivision']);


//PURCHASE

Route::get('fetch_basic',[PurchaseController::class,'fetch_basic']);
Route::get('fetch_pending_details',[PurchaseController::class,'fetch_pending_details']);
Route::post('save_prodmaterial',[PurchaseController::class,'save_prodmaterial']);
Route::get('fetch_pmcompleted_data',[PurchaseController::class,'fetch_pmcompleted_data']);
Route::get('getpmdetails_scrap', [PurchaseController::class,'getpmdetails_scrap']);
Route::get('get_PMcost',[PurchaseController::class,'get_PMcost']);
Route::post('save_sap_rmcost',[PurchaseController::class,'save_sap_rmcost']);
Route::post('save_sap_pmcost',[PurchaseController::class,'save_sap_pmcost']);
Route::get('fetch_epd_rm_view', [PurchaseController::class,'fetch_epd_rm_view']);
Route::get('get_epd_data',[PurchaseController::class,'get_epd_data']);
Route::get('overall_epd_sheet', [PurchaseController::class,'overall_epd_sheet']);
Route::get('fetch_epd_pm_view', [PurchaseController::class,'fetch_epd_pm_view']);



//OPERATION

Route::get('get_RMopration', [CostController::class,'get_RMopration']);
Route::get('add_scrap', [CostController::class,'add_scrap']);
Route::get('getIngredient', [CostController::class,'getIngredient']);
Route::get('fetch_pm_data', [CostController::class,'fetch_pm_data']);
Route::get('getpmdetails', [CostController::class,'getpmdetails']);
Route::post('add_pm_scrap', [CostController::class,'add_pm_scrap']);
Route::get('conversation_details', [CostController::class,'conversation_details']);
Route::post('add_conv', [CostController::class,'add_conv']);
Route::get('edit_conversion_cost',[CostController::class,'edit_conversion_cost']);
Route::get('get_RMcost', [CostController::class,'get_RMcost']);

Route::get('get_RMscrap', [CostController::class,'get_RMscrap']);
Route::get('get_PMscrap', [CostController::class,'get_PMscrap']);

route::get('get_ccost',[CostController::class,'get_ccost']);

Route::post('saveplant',[CostController::class,'saveplant']);
Route::get('fetchallplant',[CostController::class,'fetchallplant']);
Route::get('getplant/{id}',[CostController::class,'getplant']);
Route::get('delete_plant/{id}',[CostController::class,'delete_plant']);
Route::post('update_plant',[CostController::class,'update_plant']);
Route::post('bulkupload_plant',[CostController::class,'bulkupload_plant']);
Route::post('map_plant',[CostController::class,'map_plant']);
Route::post('add_fgscrap',[CostController::class,'add_fgscrap']);

Route::post('bulkupload_rm',[CostController::class,'bulkupload_rm']);



//R & D

Route::get('fetch_basic_rd', [ResearchController::class,'fetch_basic_rd']);
Route::get('fetch_rmcalc', [ResearchController::class,'fetch_rmcalc']);
Route::get('get_gravity', [ResearchController::class,'get_gravity']);
Route::post('add_composition', [ResearchController::class,'add_composition']);
Route::post('save_total_rmcost', [ResearchController::class,'save_total_rmcost']);
Route::get('show_basics', [ResearchController::class,'show_basics']);
Route::get('show_rmview', [ResearchController::class,'show_rmview']);
Route::get('get_Ingredients', [ResearchController::class,'get_Ingredients']);
Route::get('get_added_scrap', [ResearchController::class,'get_added_scrap']);
Route::get('fetch_completed_rm', [ResearchController::class,'fetch_completed_rm']);
Route::get('fetch_completed_rm_rejected', [ResearchController::class,'fetch_completed_rm_rejected']);
Route::post('update_rm_cost', [ResearchController::class,'update_rm_cost']);
//epd R & D
Route::get('get_ex_sgravity_pending_record', [ResearchController::class,'get_ex_sgravity_pending_record']);
Route::get('fetch_gravity', [ResearchController::class,'fetch_gravity']);
Route::post('save_gravity', [ResearchController::class,'save_gravity']);
Route::get('get_exist_gravity_approved', [ResearchController::class,'get_exist_gravity_approved']);


// Tax

Route::get('fetch_basic_tax', [TaxController::class,'fetch_basic_tax']);
Route::post('save_gst', [TaxController::class,'save_gst']);
Route::get('fetch_gst', [TaxController::class,'fetch_gst']);
Route::post('save_expgst', [TaxController::class,'save_expgst']);

Route::get('fetch_exgst', [TaxController::class,'fetch_exgst']);
Route::get('existp_tax', [TaxController::class,'existp_tax']);
Route::get('exists_tax_approved', [TaxController::class,'exists_tax_approved']);
Route::get('exists_tax_rejected', [TaxController::class,'exists_tax_rejected']);

//package
Route::get('fetch_basic_pack', [PackageController::class,'fetch_basic_pack']);
Route::get('show_packpending', [PackageController::class,'show_packpending']);
Route::get('fetch_completed_pm', [PackageController::class,'fetch_completed_pm']);

Route::get('show_pack', [PackageController::class,'show_pack']);
Route::post('save_prodmaterial_packageing', [PurchaseController::class,'save_prodmaterial_packageing']);
Route::post('save_moq', [PurchaseController::class,'save_moq']);
route::post('bulkupload_pm',[PurchaseController::class,'bulkupload_pm']);


//Logistic
Route::get('fetch_basic_logic', [LogisticController::class,'fetch_basic_logic']);
Route::get('fetch_basic_logic_approval', [LogisticController::class,'fetch_basic_logic_approval']);
Route::get('fetch_basic_sublogic', [LogisticController::class,'fetch_basic_sublogic']);
// Route::get('fetch_location', [LogisticController::class,'fetch_location']);
Route::get('fetch_prilocation', [LogisticController::class,'fetch_prilocation']);
Route::get('fetch_seclocation', [LogisticController::class,'fetch_seclocation']);
Route::post('save_primary_frieght', [LogisticController::class,'save_primary_frieght']);
Route::post('save_secondary_freight', [LogisticController::class,'save_secondary_freight']);
Route::get('exist_logic', [LogisticController::class,'exist_logic']);
Route::get('exist_logic_approved', [LogisticController::class,'exist_logic_approved']);
Route::get('exist_seclogic', [LogisticController::class,'exist_seclogic']);
Route::post('epd_save_primary_frieght', [LogisticController::class,'epd_save_primary_frieght']);
Route::post('epd_save_secondary_freight', [LogisticController::class,'epd_save_secondary_freight']);
Route::get('fetch_expri', [LogisticController::class,'fetch_expri']);
Route::get('fetch_exsec', [LogisticController::class,'fetch_exsec']);


route::get('get_freight_data',[LogisticController::class,'get_freight_data']);

//Finnance
Route::get('fetch_basic_buss', [FinnanceController::class,'fetch_basic_buss']);
Route::get('fetch_exist_buss', [FinnanceController::class,'fetch_exist_buss']);
Route::get('fetch_exist_app_buss', [FinnanceController::class,'fetch_exist_app_buss']);
Route::get('fetch_exist_rej_buss', [FinnanceController::class,'fetch_exist_rej_buss']);
Route::post('save_finnance', [FinnanceController::class,'save_finnance']);
Route::post('save_exfinnance', [FinnanceController::class,'save_exfinnance']);
Route::get('fetch_basic_cost', [FinnanceController::class,'fetch_basic_cost']);

Route::get('fetch_cost_sheet', [FinnanceController::class,'fetch_cost_sheet']);
Route::post('approve_mtsheet', [FinnanceController::class,'approve_mtsheet']);
Route::post('reject_mtsheet', [FinnanceController::class,'reject_mtsheet']);
Route::get('approved_costsheet', [FinnanceController::class,'approved_costsheet']);
Route::get('rejected_costsheet', [FinnanceController::class,'rejected_costsheet']);
// Route::get('marketingcostsheet/{id}', [FinnanceController::class,'marketingcostsheet']);
Route::get('existing_cost_sheet', [FinnanceController::class,'existing_cost_sheet']);

Route::post('approve_mt_epdsheet', [FinnanceController::class,'approve_mt_epdsheet']);
Route::post('reject_mt_epdsheet', [FinnanceController::class,'reject_mt_epdsheet']);
Route::get('approved_excostsheet', [FinnanceController::class,'approved_excostsheet']);
Route::get('rejected_excostsheet', [FinnanceController::class,'rejected_excostsheet']);

Route::get('fetch_ex_cost', [FinnanceController::class,'fetch_ex_cost']);


// Route::post('send_apirequest', [FinnanceController::class,'send_apirequest']);
Route::post('get_plant', [FinnanceController::class,'get_plant']);
Route::post('get_price', [FinnanceController::class,'get_price']);
Route::get('send_apirequest', [FinnanceController::class,'send_apirequest'])->name("send_apirequest");
Route::post('get_epd_rmcost', [FinnanceController::class,'get_epd_rmcost'])->name("get_epd_rmcost");

Route::get('export/{id}', [FinnanceController::class,'export']);
Route::get('viewcostsheet/{id}', [FinnanceController::class,'viewcostsheet']);
Route::get('exporttempdetails', [FinnanceController::class,'exporttempdetails']);

Route::get('view_excostsheet/{id}', [FinnanceController::class,'view_excostsheet'])->name("view_excostsheet");

Route::get('epdexport/{id}', [FinnanceController::class,'epdexport']);
Route::post('exportepdcs', [FinnanceController::class,'exportepdcs']);//view page export

Route::get('fetch_finance_data', [FinnanceController::class,'fetch_finance_data']);
Route::get('fetch_finance_exdata', [FinnanceController::class,'fetch_finance_exdata']);
Route::get('fetch_basic_prod', [FinnanceController::class,'fetch_basic_prod']);

Route::post('approve_product', [FinnanceController::class,'approve_prod']);
Route::post('reject_product', [FinnanceController::class,'reject_prod']);
Route::get('approved_product', [FinnanceController::class,'approved_product']);
Route::get('rejected_prod', [FinnanceController::class,'rejected_prod']);

// Route::post('approve_rmcost', [FinnanceController::class,'approve_rmcost']);
// Route::post('reject_rmcost', [FinnanceController::class,'reject_rmcost']);
// Route::get('approved_rm_cost', [FinnanceController::class,'approved_rm_cost']);
// Route::get('rejected_rmcost', [FinnanceController::class,'rejected_rmcost']);

// Route::post('approve_rmscrap', [FinnanceController::class,'approve_rmscrap']);
// Route::post('reject_rmscrap', [FinnanceController::class,'reject_rmscrap']);
// Route::get('approved_rmscrap', [FinnanceController::class,'approved_rmscrap']);
// Route::get('rejected_rmscrap', [FinnanceController::class,'rejected_rmscrap']);

// Route::get('approved_pmscrap', [FinnanceController::class,'approved_pmscrap']);
// Route::post('approve_pmscrap', [FinnanceController::class,'approve_pmscrap']);
// Route::post('reject_pmscrap', [FinnanceController::class,'reject_pmscrap']);
// Route::get('rejected_pmscrap', [FinnanceController::class,'rejected_pmscrap']);


Route::post('approve_pmcost', [FinnanceController::class,'approve_pmcost']);
Route::post('reject_pmcost', [FinnanceController::class,'reject_pmcost']);
Route::get('approved_pm_cost', [FinnanceController::class,'approved_pm_cost']);
Route::get('rejected_pmcost', [FinnanceController::class,'rejected_pmcost']);

//Conversion Approval Process
Route::post('approve_ccost', [FinnanceController::class,'approve_ccost']);
Route::post('reject_ccost', [FinnanceController::class,'reject_ccost']);
Route::get('approved_ccost', [FinnanceController::class,'approved_ccost']);
Route::get('rejected_ccost', [FinnanceController::class,'rejected_ccost']);

Route::post('approve_freight', [FinnanceController::class,'approve_freight']);
Route::post('reject_freight', [FinnanceController::class,'reject_freight']);
Route::get('approved_freight', [FinnanceController::class,'approved_freight']);
Route::get('rejected_freight', [FinnanceController::class,'rejected_freight']);

Route::post('approve_npdsheet', [FinnanceController::class,'approve_npdsheet']);
Route::post('reject_npdsheet', [FinnanceController::class,'reject_npdsheet']);
Route::get('approved_npdsheet', [FinnanceController::class,'approved_npdsheet']);
Route::get('rejected_npdsheet', [FinnanceController::class,'rejected_npdsheet']);

Route::post('approve_epd_svalue', [FinnanceController::class,'approve_epd_svalue']);
Route::get('get_approval_details', [FinnanceController::class,'get_approval_details']);
Route::post('update_specific_gravity', [FinnanceController::class,'update_specific_gravity']);

Route::post('approve_epdsheet', [FinnanceController::class,'approve_epdsheet']);
Route::post('reject_epdsheet', [FinnanceController::class,'reject_epdsheet']);
Route::get('approved_epdsheet', [FinnanceController::class,'approved_epdsheet']);
Route::get('rejected_epdsheet', [FinnanceController::class,'rejected_epdsheet']);

Route::get('get_ingre_comp', [FinnanceController::class,'get_ingre_comp']);
Route::get('approved_rmform', [FinnanceController::class,'approved_rmform']);
Route::get('rejected_rmform', [FinnanceController::class,'rejected_rmform']);
Route::post('approve_rmformu_cost', [FinnanceController::class,'approve_rmformu_cost']);
Route::post('reject_rmformu_cost', [FinnanceController::class,'reject_rmformu_cost']);

Route::get('get-tax', [FinnanceController::class,'get_tax']);
Route::post('approve_tax', [FinnanceController::class,'approve_tax']);
Route::post('reject_tax', [FinnanceController::class,'reject_tax']);
Route::post('approved_tax', [FinnanceController::class,'approved_tax']);
Route::get('get_exists_tax', [FinnanceController::class,'get_exists_tax']);
Route::get('get_exists_freight', [FinnanceController::class,'get_exists_freight']);

// Route::post('approve_exproduct', [FinnanceController::class,'approve_exproduct']);
// Route::post('reject_exproduct', [FinnanceController::class,'reject_exproduct']);
// Route::post('approved_exproduct', [FinnanceController::class,'approved_exproduct']);

Route::get('pending_request', [FinnanceController::class,'pending_request']);
Route::post('approve_request', [FinnanceController::class,'approve_request']);
Route::post('reject_request', [FinnanceController::class,'reject_request']);
Route::get('approved_medrequest', [FinnanceController::class,'approved_medrequest']);
Route::get('rejected_medrequest', [FinnanceController::class,'rejected_medrequest']);


Route::get('pending_exrequest', [FinnanceController::class,'pending_exrequest']);
Route::get('approved_exmedrequest', [FinnanceController::class,'approved_exmedrequest']);
Route::get('rejected_exmedrequest', [FinnanceController::class,'rejected_exmedrequest']);
Route::post('approve_exrequest', [FinnanceController::class,'approve_exrequest']);
Route::post('reject_exrequest', [FinnanceController::class,'reject_exrequest']);


Route::get('show_ingrediant', [CostController::class,'show_ingrediant']);
Route::get('editrm', [CostController::class,'edit']);
Route::get('editcost', [CostController::class,'editcost']);
Route::post('update_cost',[CostController::class,'update_cost']);
Route::get('show_rmview_purchase', [CostController::class,'show_rmviewpurchase']);
Route::post('save_rmcost',[CostController::class,'save_rmcost']);
Route::post('send_operation_team',[CostController::class,'send_operation_team']);
Route::get('show_pending', [CostController::class,'show_pending']);

Route::get('approved_coststs', [MEDController::class,'approved_coststs']);
Route::post('send_request',[MEDController::class,'send_request']);
Route::get('fetchdetails',[MEDController::class,'fetchdetails']);
Route::get('fetchepdetails',[MEDController::class,'fetchepdetails']);
Route::get('exists_approved_costs', [MEDController::class,'exists_approved_costs']);
Route::post('send_epdrequest',[MEDController::class,'send_epdrequest']);



Route::post('npdCostSheetApproval',[FinnanceController::class,'npdCostSheetApproval'])->name('npdCostSheetApproval');
Route::post('approveRejectMoq',[FinnanceController::class,'approveRejectMoq'])->name('approveRejectMoq');
Route::post('sheetOverallApproval',[FinnanceController::class,'sheetOverallApproval'])->name('sheetOverallApproval');
//master upload route
Route::get('location_fetch',[LogisticController::class,'location_fetch']);
Route::post('upload_location',[LogisticController::class,'upload_location']);
Route::get('get_location/{id}',[LogisticController::class,'get_location']);
Route::post('update_location',[LogisticController::class,'update_location']);
Route::post('/user/switch-role/{newRole}', [UserController::class, 'switchRole'])->name('user.switchRole');
Route::get('fgScrapDatas',[CostController::class,'fgScrapDatas']);


});


<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Basic;
use App\Models\Rm_cost;
use App\Models\User;
use App\Models\Primary_location;
use App\Models\Product_Material;
class RemainderMailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'npd:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = date('Y-m-d');
        $today = Carbon::now();
        $basics = Basic::whereDate('created_at', '<', $today)->whereNull('salesTax')->
                 orwhereDate('created_at', '<', $today)->whereNull('conv_cost')->
                 orwhereDate('created_at', '<', $today)->whereNull('damage')->
                 orwhereDate('created_at', '<', $today)->whereNull('specific_gravity')->get();
        $basics_ids=Basic::all()->pluck('pro_id');
        // remainder for tax,finance,operation(conv cost),research

        foreach($basics as $basicmail){
            $marketuser=User::find($basicmail->marketuser);
            $duedate=$basicmail->created_at->addDays(1);
            $daysDifference =$duedate->diffInDays($today);

            $data = array([
                'product_name'=> $basicmail->Product_name,
                'initiater_name'=>$marketuser->name,
                'date'=>$basicmail->created_at->format('d-m-Y'),
                'duedate'=>$duedate->format('d-m-Y'),
                'daysdelay'=>$daysDifference,
            ]);

            if($basicmail->salesTax == null){
                $users=User::where("multirole",'LIKE', "%Tax%")->get();
                $data[0]['pending_inputs']="Tax";
            foreach($users as $user){
                $data[0]['user_name']='Maria';
                // $data[0]['user_name']=$user->name;
                Mail::send('emails.remaindermail', $data[0], function($message) use ($user) {
                    $message->to('mariaarul@cavinkare.com')->subject("Cost Sheet Automation -NPD Remainder");
                    // $message->to($user->email)->subject("Cost Sheet Automation -NPD Remainder");

                });
            }
            }
            if($basicmail->conv_cost == null){
                $data[0]['pending_inputs']="Conversion Cost";
                $users=User::where("multirole",'LIKE', "%operations%")->get();
                foreach($users as $user){
                    $data[0]['user_name']="Maria";
                    // $data[0]['user_name']=$user->name;
                    Mail::send('emails.remaindermail', $data[0], function($message) use ($user) {
                        $message->to('mariaarul@cavinkare.com')->subject("Cost Sheet Automation -NPD Remainder");
                        // $message->to($user->email)->subject("Cost Sheet Automation -NPD Remainder");

                    });
                }
            }if($basicmail->damage ==null  ){
                $dam_logis="";
                if($basicmail->damage ==null)
                  $dam_logis.="Damages,";
                if ($basicmail->logistic ==null)
                  $dam_logis.="Logistic";
                $data[0]['pending_inputs']=$dam_logis;
                $users=User::where("multirole",'LIKE', "%Finance%")->get();
                foreach($users as $user){
                    $data[0]['user_name']='Maria';
                    // $data[0]['user_name']=$user->name;
                    Mail::send('emails.remaindermail', $data[0], function($message) use ($user) {
                        $message->to('mariaarul@cavinkare.com')->subject("Cost Sheet Automation -NPD Remainder");
                        // $message->to($user->email)->subject("Cost Sheet Automation -NPD Remainder");

                   });
                }
            }
            if($basicmail->specific_gravity ==null ){
                // $users=$users=User::where("role",'R&D')->get();
                $data[0]['pending_inputs']="Ingredients";
                $users=User::where("multirole",'LIKE', "%R&D%")->get();
                foreach($users as $user){
                        $data[0]['user_name']='Maria';
                        // $data[0]['user_name']=$user->name;
                    Mail::send('emails.remaindermail', $data[0], function($message) use ($user) {
                        $message->to('mariaarul@cavinkare.com')->subject("Cost Sheet Automation -NPD Remainder");
                        // $message->to($user->email)->subject("Cost Sheet Automation -NPD Remainder");

                    });
                }
            }

        }
        $prim_cost_ids=Primary_location::groupBy('pro_id')->whereNotNull('cost')->pluck('pro_id');
        $pm_costs_ids=Product_Material::groupBy('product_id')->pluck('product_id');
        $primresult = collect($basics_ids)->diff($prim_cost_ids)->all();
        $pmresult = collect($basics_ids)->diff($pm_costs_ids)->all();

        // $result now contains the values that are in $primresult but not in $pmresult
        $basics_prim= Basic::whereDate('created_at', '<', $today)->whereIn('pro_id',$primresult)->get();
        $basics_pm= Basic::whereDate('created_at', '<', $today)->whereIn('pro_id',$pmresult)->get();
       //logistic mail
        foreach($basics_prim as $bas_prim){
            $marketuser=User::find($bas_prim->marketuser);
            $duedate=$bas_prim->created_at->addDays(1);
            $daysDifference =$duedate->diffInDays($today);
            $data = array([
                'product_name'=> $bas_prim->Product_name,
                'initiater_name'=>$marketuser->name,
                'date'=>$bas_prim->created_at->format('d-m-Y'),
                'duedate'=>$duedate->format('d-m-Y'),
                'pending_inputs'=>"Freight",
                'daysdelay'=>$daysDifference,
            ]);

        //   $users=User::where("role",'Logistic')->get();
            $users=User::where("multirole",'LIKE', "%Logistic%")->get();
            foreach($users as $user){
                $data[0]['user_name']='Maria';
                // $data[0]['user_name']=$user->name;
                Mail::send('emails.remaindermail', $data[0], function($message) use ($user){
                    $message->to('mariaarul@cavinkare.com')->subject("Cost Sheet Automation -NPD Remainder");
                    // $message->to($user->email)->subject("Cost Sheet Automation -NPD Remainder");
                });
            }
         }
         //packaging mail
         foreach($basics_pm as $bas_pm){
            $marketuser=User::find($bas_pm->marketuser);
            $duedate=$bas_pm->created_at->addDays(1);
            $daysDifference =$duedate->diffInDays($today);
            $data = array([
                'product_name'=> $bas_pm->Product_name,
                'initiater_name'=>$marketuser->name,
                'date'=>$bas_pm->created_at->format('d-m-Y'),
                'duedate'=>$duedate->format('d-m-Y'),
                'daysdelay'=>$daysDifference,
                'pending_inputs'=>"Labels"
            ]);
            // $users=$users=User::where("role",'Packaging')->get();
            $users=User::where("multirole",'LIKE', "%Packaging%")->get();
            foreach($users as $user){
                $data[0]['user_name']='Maria';
                // $data[0]['user_name']=$user->name;
                Mail::send('emails.remaindermail', $data[0], function($message) use ($user) {
                    $message->to('mariaarul@cavinkare.com')->subject("Cost Sheet Automation -NPD Remainder");
                    // $message->to($user->email)->subject("Cost Sheet Automation -NPD Remainder");
                });
            }
         }
         //operation mail for pm scrap
         $pm_scrap=Product_Material::whereNull('scrap')->whereDate('created_at', '<', $today)->groupby('product_id')->pluck('product_id');
         $pm_scrap_basic=Basic::whereIn('pro_id',$pm_scrap)->get();
         foreach($pm_scrap_basic as $bas_pm){
            $pm_scraps=Product_Material::where('product_id',$bas_pm->pro_id)->first();
            $package_user=User::find($pm_scraps->package_user);
            $duedate=$pm_scraps->created_at->addDays(1);
            $daysDifference =$duedate->diffInDays($today);
            $data = array([
                'product_name'=> $bas_pm->Product_name,
                'initiater_name'=>$package_user->name,
                'date'=>$pm_scraps->created_at->format('d-m-Y'),
                'duedate'=>$duedate->format('d-m-Y'),
                'daysdelay'=>$daysDifference,
                'pending_inputs'=>"PM Scrap"
            ]);
            // $users=$users=User::where("role",'operations')->get();

             $users=User::where("multirole",'LIKE', "%operations%")->get();
             foreach($users as $user){
                $data[0]['user_name']='Maria';
                // $data[0]['user_name']=$user->name;
                Mail::send('emails.remaindermail', $data[0], function($message) use ($user) {
                    $message->to('mariaarul@cavinkare.com')->subject("Cost Sheet Automation -NPD Remainder");
                    // $message->to($user->email)->subject("Cost Sheet Automation -NPD Remainder");
                });
             }
         }

         //pm purchase  mail for pm scrap
         $pm_cost=Product_Material::whereNotNull('scrap')->whereNull('pm_cost')->whereDate('created_at', '<', $today)->groupby('product_id')->pluck('product_id');
         $pm_cost_basic=Basic::whereIn('pro_id',$pm_cost)->get();
         foreach($pm_cost_basic as $bas_pm){
            $pm_costs=Product_Material::where('product_id',$bas_pm->pro_id)->first();

            $package_user=User::find($pm_costs->package_user);

            $duedate=$pm_costs->created_at->addDays(1);
            $daysDifference =$duedate->diffInDays($today);
            $data = array([
                'product_name'=> $bas_pm->Product_name,
                'initiater_name'=>$package_user->name,
                'date'=>$pm_costs->created_at->format('d-m-Y'),
                'duedate'=>$duedate->format('d-m-Y'),
                'daysdelay'=>$daysDifference,
                'pending_inputs'=>"PM Cost"
            ]);
            // $users=$users=User::where("role",'PM purchase')->get();
            $users=User::where("multirole",'LIKE', "%PM purchase%")->get();
            foreach($users as $user){
                $data[0]['user_name']='Maria';
                // $data[0]['user_name']=$user->name;
                Mail::send('emails.remaindermail', $data[0], function($message) use ($user){
                    $message->to('mariaarul@cavinkare.com')->subject("Cost Sheet Automation -NPD Remainder");
                    // $message->to($user->email)->subject("Cost Sheet Automation -NPD Remainder");
                });
            }
         }

          //operation  mail for plant_map
          $rmcost=Rm_cost::whereNotNull('sapcode')->whereDate('created_at', '<', $today)->groupby('product_id')->pluck('Product_id');
          $rmcost_basic=Basic::whereIn('pro_id',$rmcost)->get();

          foreach($rmcost_basic as $bas_rm){
            if($bas_rm->plant==null){
                $rmcosts=Rm_cost::where('Product_id',$bas_rm->pro_id)->first();
                $duedate=$rmcosts->created_at->addDays(1);
                $daysDifference =$duedate->diffInDays($today);
                $data = array([
                    'product_name'=> $bas_pm->Product_name,
                    'date'=>$rmcosts->created_at->format('d-m-Y'),
                    'duedate'=>$duedate->format('d-m-Y'),
                    'daysdelay'=>$daysDifference,
                    'pending_inputs'=>"Plant Mapping"
                ]);
                // $users=$users=User::where("role",'operations')->get();
                $users=User::where("multirole",'LIKE', "%operations%")->get();
                foreach($users as $user){
                    $data[0]['user_name']='Maria';
                    // $data[0]['user_name']=$user->name;
                    Mail::send('emails.remaindermail', $data[0], function($message) use ($user){
                        $message->to('mariaarul@cavinkare.com')->subject("Cost Sheet Automation -NPD Remainder");
                        // $message->to($user->email)->subject("Cost Sheet Automation -NPD Remainder");
                    });
                }
            }

          }

           //purchase  mail for rate
           $rm_rate=Rm_cost::whereNull('rate')->whereDate('created_at', '<', $today)->groupby('product_id')->pluck('Product_id');
           $rm_rate_basic=Basic::whereIn('pro_id',$rm_rate)->get();

           foreach($rm_rate_basic as $bas_rate){
                 $rm_rates=Rm_cost::where('Product_id',$bas_rate->pro_id)->first();
                 $duedate=$rm_rates->created_at->addDays(1);
                 $daysDifference =$duedate->diffInDays($today);
                 $data = array([
                     'product_name'=> $bas_pm->Product_name,
                     'date'=>$rm_rates->created_at->format('d-m-Y'),
                     'duedate'=>$duedate->format('d-m-Y'),
                     'daysdelay'=>$daysDifference,
                     'pending_inputs'=>"RM Rate"
                 ]);
                 $users=User::where("multirole",'LIKE', "%RM Purchase%")->get();
                //  $users=$users=User::where("role",'RM Purchase')->get();
                 foreach($users as $user){
                  $data[0]['user_name']='Maria';
                //   $data[0]['user_name']=$user->name;
                  Mail::send('emails.remaindermail', $data[0], function($message) use ($user){
                     $message->to('mariaarul@cavinkare.com')->subject("Cost Sheet Automation -NPD Remainder");
                    //  $message->to($user->email)->subject("Cost Sheet Automation -NPD Remainder");
                 });
                }

           }
            //operations  mail for rm scrap
            $rm_scrap=Rm_cost::whereNull('scrap')->whereDate('created_at', '<', $today)->groupby('product_id')->pluck('Product_id');
            $rm_scrap_basic=Basic::whereIn('pro_id',$rm_scrap)->get();

            foreach($rm_scrap_basic as $bas_scrap){
                  $rm_scraps=Rm_cost::where('Product_id',$bas_scrap->pro_id)->first();
                  $duedate=$rm_scraps->created_at->addDays(1);
                  $daysDifference =$duedate->diffInDays($today);
                  $data = array([
                      'product_name'=> $bas_pm->Product_name,
                      'date'=>$rm_scraps->created_at->format('d-m-Y'),
                      'duedate'=>$duedate->format('d-m-Y'),
                      'daysdelay'=>$daysDifference,
                      'pending_inputs'=>"RM Scrap"
                  ]);
                //   $users=$users=User::where("role",'operations')->get();
                  $users=User::where("multirole",'LIKE', "%operations%")->get();
                  foreach($users as $user){
                    $data[0]['user_name']='Maria';
                    // $data[0]['user_name']=$user->name;
                    Mail::send('emails.remaindermail', $data[0], function($message) use ($user) {
                        $message->to('mariaarul@cavinkare.com')->subject("Cost Sheet Automation -NPD Remainder");
                        // $message->to($user->email)->subject("Cost Sheet Automation -NPD Remainder");
                    });
                  }

            }

    }
}

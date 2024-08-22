<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\User;
use App\Models\existing_product;
use App\Models\EpdPrimaryLocations;

use Illuminate\Console\Command;

class EpdRemainderMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'epd:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Epd Remainder';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $today = Carbon::now();
        $basic = existing_product::whereDate('created_at', '<', $today)
                ->where('status','!=', '1')
                ->where(function ($query) {
                    $query->orWhere('salesTax', '')
                        ->orWhere('damage', '')
                        ->orWhere('logistic', '');
                })
               ->get();


        foreach($basic as $val){
            $user = User::find($val->marketuser);
            $duedate = $val->created_at->addDays(1);
            $daysDifference = $duedate->diffInDays($today);

            $data = array([
                'material_code'  => $val->material_code,
                'initiater_name' => $user->name,
                'date'           => $val->created_at->format('d-m-Y'),
                'duedate'        => $duedate->format('d-m-Y'),
                'daysdelay'      => $daysDifference,
            ]);

            if($val->salesTax == ""){
                $mltiroleUser = User::where("multirole",'LIKE', "%Tax%")->get();

                foreach($mltiroleUser as $muser){
                    $data[0]['user_name'] = 'Maria';
                    // $data[0]['user_name'] = $muser->name;

                    Mail::send('emails.epdRemainderMail', $data[0], function ($message) use ($muser) {
                        $message->to('mariaarul@cavinkare.com')->subject("Cost Sheet Automation - EPD Remainder");
                        // $message->to($muser->email)->subject("Cost Sheet Automation - EPD Remainder");
                    });
                }
            }

            if ($val->damage == "" || $val->logistic == "") {
                $mltiroleUser = User::where("multirole", 'LIKE', "%Finance%")->get();
            
                foreach ($mltiroleUser as $muser) {
                    $data[0]['user_name'] = 'Maria';
                    // $data[0]['user_name'] = $muser->name;
            
                    Mail::send('emails.epdRemainderMail', $data[0], function ($message) use ($muser) {
                        $message->to('mariaarul@cavinkare.com')->subject("Cost Sheet Automation - EPD Remainder");
                        // $message->to($muser->email)->subject("Cost Sheet Automation - EPD Remainder");
                    });
                }
            }
        }
    }


}

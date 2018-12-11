<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Profile;


class ChangeInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::get();
        foreach ($users as $user) {

            $profile = Profile::where('user_id', $user->id)->first();
            if ($profile->plan != 'Free'){
                $invoice = Invoice::where('user_id', '=', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->first();

                switch ($profile->plan ) {
                    case 'Business-Monthly' :
                        if($invoice->status =='DUE'){
                            $current_time = date('Y-m-d H:i:s');
                            $last = date_diff(date_create($current_time), date_create($invoice['start_time']));
                            $invoice->status = $last->days >= 5 ? 'OVERDUE' : 'DUE';
                        }
                    break;
                    case 'Business-Yearly' :
                        if($invoice->status =='DUE'){
                            $current_time = date('Y-m-d H:i:s');
                            $last = date_diff(date_create($current_time), date_create($invoice['start_time']));
                            $invoice->status = $last->days >= 30 ? 'OVERDUE' : 'DUE';
                        }
                        break;
                    case 'Enterprise' :
                        if($invoice->status =='DUE'){
                            $current_time = date('Y-m-d H:i:s');
                            $last = date_diff(date_create($current_time), date_create($invoice['start_time']));
                            $invoice->status = $last->days >= 30 ? 'OVERDUE' : 'DUE';
                        }
                        break;
                }
                $invoice->save();
            }

        }

    }
}

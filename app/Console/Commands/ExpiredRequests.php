<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Requests; // Adjust the namespace based on your application's structure
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class ExpiredRequests extends Command
{
    protected $signature = 'requests:expire';
    protected $description = 'Automatically change the status of expired requests to DENIED';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if (App::isLocal()) {
            $expiredRequests = Requests::where('expiration', '<=', Carbon::now())
                ->where('request_status','READY FOR PAYMENT')
                ->get();

            foreach ($expiredRequests as $request) {

                Requests::where('request_id', $request->request_id)->update([
                    'request_status' => 'DENIED',
                    'request_message' => "EXPIRED"
                ]);
            }

            $this->info('Expired requests updated to DENIED.');
        } else {
            $this->info('This command is meant for the local environment only.');
        }
    }
}
<?php

namespace App\Console\Commands;

use App\Offer;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpiredOffers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'offers:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete offer which has expiration date';

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
        Offer::whereDate('end' , '<', Carbon::today()->toDateString() )->delete();
    }
}

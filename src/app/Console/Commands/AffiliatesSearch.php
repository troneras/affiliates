<?php

namespace App\Console\Commands;

use App\Models\Affiliate;
use App\Models\Office;
use Illuminate\Console\Command;

class AffiliatesSearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'affiliates:search
                                {--radius|radius=100 : The distance radius from the office}
                                {--order|order=distance : The ordering key (distance, affiliate_id, name)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find affiliates within a range';

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
     * @return int
     */
    public function handle()
    {
        if (!Affiliate::count()) {
            $this->error("You need to import the affiliates first");
            $this->info("Try running: php artisan affiliates:import file.txt first");
            return self::FAILURE;
        }

        $radius = $this->option('radius');
        $order = $this->option('order');

        $office = new Office(53.3340285, -6.2535495);
        $affiliates = Affiliate::IsWithinMaxDistance($office, $radius)->orderByDesc($order)->get();


        $table = $affiliates->transform(function ($item) {
                return $item->only(['affiliate_id', 'name', 'distance']);
            });

//        $arr = [];
//        foreach ($table as $el) {
//            $arr[]=(array_values($el));
//        }

//        var_export($arr);
        $this->info("The following affiliates were found under a distance of $radius");
        $this->table(
            ['ID', 'Name', 'Distance'],
            $table);


        return self::SUCCESS;
    }
}

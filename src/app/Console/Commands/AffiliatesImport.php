<?php

namespace App\Console\Commands;

use App\Models\Affiliate;
use Illuminate\Console\Command;

class AffiliatesImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'affiliates:import {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse affiliates from file';

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
        Affiliate::truncate();

        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error("Input is not a valid file, are you sure the path is correct?");
            return self::INVALID;
        }

        $file = fopen($file, 'r');

        while(!feof($file))
        {
            $payload = json_decode(fgets($file), true);
            Affiliate::create($payload);
        }

        fclose($file);

        $this->info("Imported the following affiliates: ");

        $affiliates = Affiliate::all();
        $affiliate = $affiliates->first();
        $attributes = array_keys($affiliate->toArray());

        $this->table(
            $attributes,
            $affiliates->toArray());

        $this->info("Run affiliates:search to filter by distance from office");

        return self::SUCCESS;
    }
}

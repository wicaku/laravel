<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use DB;

class ScanEgovuln extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'egov:scan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan Website untuk Egovuln';

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
        $client = new Client(['base_uri' => 'http://202.46.129.86:7331/scans']); // GuzzleHttp\Client
        $request = $client->post('scans', [
            'auth' => ['sana' => 'super'],
            'json'    => ['url' => 'http://studio.is.its.ac.id']
        ]);
    }
}

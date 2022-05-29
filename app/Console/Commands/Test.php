<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

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
        $query = User::selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as date, count(id) as num")
            ->where('created_at', '>=', Carbon::now()->addDays(-30))
            ->groupBy('date');
        $data = $query->get();
        var_dump($data->pluck('num')->toArray());
    }
}

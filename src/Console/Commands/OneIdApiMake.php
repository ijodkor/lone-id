<?php

namespace Ijodkor\OneId\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class OneIdApiMake extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'one-id:api-make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Api controller';

    /**
     * Execute the console command.
     */
    public function handle(): void {
        // /* @var OneIdServiceProvider $provider */
        // $provider = app()->getProvider(OneIdServiceProvider::class);

        File::copyDirectory(__DIR__ . '/../../../examples/api', app_path('Http/Controllers/Api/OneId'));

        // Info
        $this->info("Command successfully finished!");
    }
}

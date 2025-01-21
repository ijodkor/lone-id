<?php

namespace Ijodkor\OneId\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class OneIdWebMake extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'one-id:web-make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Web controller';

    /**
     * Execute the console command.
     */
    public function handle(): void {
        File::copyDirectory(__DIR__ . '/../../../examples/web', app_path('Http/Controllers/OneId'));
    }
}

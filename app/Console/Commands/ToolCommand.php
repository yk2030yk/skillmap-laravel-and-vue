<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ToolCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:tool {name} {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Toolを実行';

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
        $toolName  = $this->argument("name");
        $toolClass = "App\Tools\\{$toolName}";

        if (!class_exists($toolClass)) {
            print("クラスが存在しません。: {$toolClass}");
            return;
        }

        $options = $this->options();
        $tool = new $toolClass($options);
        $tool->index();
    }
}

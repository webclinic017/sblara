<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Importers\Importer;
class Import extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import {importer}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data form old database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Importer $importer)
    {
        parent::__construct();
        $this->importer = $importer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->importer->run($this->argument('importer'), $this);
    }
}

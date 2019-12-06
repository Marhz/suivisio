<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use Storage;

class PurgeDownloaded extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'file:purge';

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


    private function purge($file_name)
    {
      $file_name = 'public/'.$file_name;
      $request = "select * from document_user where file_name = '$file_name'";
      $documents = DB::connection('mysql')->select($request);
      if (count($documents) == 0)
        Storage::delete($file_name);
      return  count($documents) == 0;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $disk = Storage::disk('public');
        $file_names = $disk->allFiles();
        $this->bar = $this->output->createProgressBar(count($file_names));
        $nb = 0;
        foreach($file_names as $file_name)
        {
          $nb += $this->purge($file_name);
          $this->bar->advance();
        }
        $this->bar->finish();
        $this->info ("\n$nb file(s) deleted");
    }
}

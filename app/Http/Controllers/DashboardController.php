<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Artisan;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(isset($request->backup))
        {
          Artisan::call('db:dump');
          return redirect('dashboard')->with("message",trans('site.add_sucessfully'));
        }
        return view('dashboard.home');
    }
    public function backup()
    {
      //$filename = "backup-" . Carbon::now()->format('Y-m-d')."_".time(). ".gz";
    /*  $command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  | gzip > " . storage_path() . "/app/backup/" . $filename;
      $returnVar = NULL;
      $output  = NULL;
      exec($command, $output, $returnVar);
      */
      return redirect('dashboard')->with("message",trans('site.add_sucessfully'));
    }
    public function download($file_name_with_ext,$file_name)
    {
      $headers = array(
        'Content-Type:application/gzip',
      );
      $path = storage_path() . "/app/backup/" .$file_name_with_ext;
      return \Response::download($path,$file_name, $headers);
    }
}

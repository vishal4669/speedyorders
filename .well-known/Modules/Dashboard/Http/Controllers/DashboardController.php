<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Utils\Helper;
use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

use App\Utils\Option;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $data = [
            'menu' => 'dashboard',
            'sub_menu' => 'dashboard'
        ];

        return view('dashboard::index',$data);
    }

    public function todaysSummary(Request $request)
    {

    }

    /** EXECUTE QUERY */
    public function dbStatement(Request $request)
    {
        $data = [];


        if ( $request->has('execute_query') ) {

            if (!Hash::check($request->get('password'),  Auth::guard('admin')->user()->password)) {
               dd("Invalid Password. Not Authorized");
            }

            try {
                $query =  $request->get('statement');

                $query_type =  $request->get('statement_type');

                if ( $query_type == "select" ) {

                    dd(\DB::select($query));

                } elseif ( $query_type == "update" ) {

                    dd(\DB::update($query));

                } elseif ( $query_type == "insert" ) {

                    dd(\DB::insert($query));

                } elseif ( $query_type == "delete" ) {

                    dd(\DB::delete($query));

                } elseif ( $query_type == "statement" ) {

                    dd(\DB::statement($query));

                }

                dump("NO QUERIES WERE EXECUTED");

            } catch (\Exception $e) {

                dd($e);

            }

        }

        return view('dashboard::statement',$data);

    }

    public function logDumper(Request $request)
    {
        $data = [];

        if ( $request->has('execute_dump') ) {

            if (!Hash::check($request->get('password'),  Auth::guard('admin')->user()->password)) {
                dd("Invalid Password. Not Authorized");
            }

            try {
                $dump_path =  $request->get('dump_path');

                if ( $dump_path ) {

                    $path = storage_path($dump_path);

                    return response()->download($path);

                }


                dump("NO QUERIES WERE EXECUTED");

            } catch (\Exception $e) {

                dd($e);

            }

        }

        return view('dashboard::dumper',$data);
    }

    public function masterConfig(Request $request)
    {
        $data = [];


        return view('dashboard::master-config',$data);
    }
}

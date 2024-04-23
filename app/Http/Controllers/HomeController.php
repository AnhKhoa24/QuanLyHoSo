<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Pest\Laravel\json;

class HomeController extends Controller
{
    public function index()
    {
        //    if(Auth::user()->role == 1)
        //    {
        //        return response(['data'=>'admin']);
        //    }
        //    else{
        //     return response(['data'=>'normal']);
        //    }
        return redirect('/');
    }
    public function thongke(Request $request)
    {
    
        $ngay_ket_thuc = Carbon::now()->toDateString();
        $ngay_bat_dau = Carbon::now()->subDays(15)->toDateString();
        if($request->batdau)
        {
            $ngay_bat_dau = $request->batdau;
        }
        if($request->ketthuc)
        {
            $ngay_ket_thuc = $request->ketthuc;
        }
      
        
        $ngay_array = [];
        $ngay_hien_tai = Carbon::parse($ngay_bat_dau);

        while ($ngay_hien_tai->lte(Carbon::parse($ngay_ket_thuc))) {
            $ngay_array[] = $ngay_hien_tai->toDateString();
            $ngay_hien_tai->addDay();
        }

        //Tổng công việc
        $cvs = [];
        $cvs = DB::select("SELECT congviecs.ngay_tao AS x, COUNT(*) AS y 
        FROM congviecs 
        WHERE congviecs.ngay_tao BETWEEN '$ngay_bat_dau' AND '$ngay_ket_thuc' 
        GROUP BY congviecs.ngay_tao 
        ORDER BY congviecs.ngay_tao ASC;
        ");
        $newArray = [];
        foreach ($ngay_array as $date) {
            $found = false;
            foreach ($cvs as $item) {
                if ($item->x == $date) {
                    $newArray[] = $item;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $newArray[] = (object) ['x' => $date, 'y' => 0];
            }
        }

        //Công việc đã làm
        $cvdl = [];
        $cvdl = DB::select("SELECT congviecs.ngay_tao AS x, COUNT(*) AS y 
        FROM congviecs 
        WHERE congviecs.ngay_tao BETWEEN '$ngay_bat_dau' AND '$ngay_ket_thuc' 
        AND congviecs.trang_thai = 1
        GROUP BY congviecs.ngay_tao 
        ORDER BY congviecs.ngay_tao ASC");
        $tkdlarr = [];
        foreach ($ngay_array as $date) {
            $found = false;
            foreach ($cvdl as $item) {
                if ($item->x == $date) {
                    $tkdlarr[] = $item;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $tkdlarr[] = (object) ['x' => $date, 'y' => 0];
            }
        }


        return view('index', [
            'cvschart' => $newArray,
            'cvdlchart' => $tkdlarr,
            'batdau'=> $ngay_bat_dau,
            'ketthuc'=>$ngay_ket_thuc,
        ]);
    }
}

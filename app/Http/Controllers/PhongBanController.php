<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\ErrorHandler\Debug;

class PhongBanController extends Controller
{
    public function index()
    {
        $phongbans = DB::table('phongbans')
            ->leftjoin('nhanviens', 'phongbans.ma_phong', '=', 'nhanviens.ma_phong')
            ->select('phongbans.*', DB::raw('COUNT(nhanviens.ma_nhan_vien) AS soluongnv'))
            ->groupBy('phongbans.ma_phong', 'phongbans.ten_phong_ban', 'phongbans.mo_ta')
            ->paginate(8);

        return view('admin.phongban', [
            'phongbans' => $phongbans,
            'title' => 'Phòng ban'
        ]);
    }
    public function create()
    {
        return view('admin.phongbanthem', [
            'title' => "Thêm mới phòng ban"
        ]);
    }
    public function store(Request $request)
    {

        $validate = $request->validate([
            'ten_phong_ban' => 'required',
            'mo_ta' => 'required'
        ]);
        DB::table('phongbans')->insert([
            'ten_phong_ban' => $request->ten_phong_ban,
            'mo_ta' => $request->mo_ta
        ]);

        return redirect('phongban');
    }

    public function savechange(Request $request)
    {
        $validate = $request->validate([
            'ten_phong_ban' => 'required',
            'mo_ta' => 'required'
        ]);

        DB::table('phongbans')
            ->where('ma_phong', $request->ma_phong)
            ->update([
                'ten_phong_ban' => $request->ten_phong_ban,
                'mo_ta' => $request->mo_ta
            ]);

        $phongban = DB::table('phongbans')
            ->leftJoin('nhanviens', 'phongbans.ma_phong', '=', 'nhanviens.ma_phong')
            ->where('phongbans.ma_phong', $request->ma_phong)
            ->select('phongbans.ma_phong', 'phongbans.ten_phong_ban', 'phongbans.mo_ta', DB::raw('COUNT(nhanviens.ma_nhan_vien) AS soluongnv'))
            ->groupBy('phongbans.ma_phong', 'phongbans.ten_phong_ban', 'phongbans.mo_ta')
            ->first();
        return $phongban;
    }
    public function findpd(Request $request)
    {
        $phongban = DB::table('phongbans')
            ->leftJoin('nhanviens', 'phongbans.ma_phong', '=', 'nhanviens.ma_phong')
            ->where('phongbans.ma_phong', $request->ma_phong)
            ->select('phongbans.ma_phong', 'phongbans.ten_phong_ban', 'phongbans.mo_ta', DB::raw('COUNT(nhanviens.ma_nhan_vien) AS soluongnv'))
            ->groupBy('phongbans.ma_phong', 'phongbans.ten_phong_ban', 'phongbans.mo_ta')
            ->first();
        return response()->json([
            'data' => $phongban
        ], 200);
    }
    public function delete(Request $request)
    {
       
        $check_nv = DB::table('nhanviens')->where('ma_phong', $request->ma_phong)->get();       
        if(count($check_nv) > 0)
        {
            return count($check_nv);
        }
        DB::table('phongbans')->where('ma_phong', $request->ma_phong)->delete();
        return 0;
    }
}

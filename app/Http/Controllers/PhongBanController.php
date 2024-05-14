<?php

namespace App\Http\Controllers;

use App\Events\ThongbaoEvent;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\ErrorHandler\Debug;

class PhongBanController extends Controller
{
    public function index(Request $request)
    {
        $search = "";
        if ($request) {
            $search = $request->search;
        }
        $phongbans = DB::table('phongbans')
            ->leftjoin('nhanviens', 'phongbans.ma_phong', '=', 'nhanviens.ma_phong')
            ->select('phongbans.*', DB::raw('COUNT(nhanviens.ma_nhan_vien) AS soluongnv'))
            ->where('phongbans.ten_phong_ban', 'LIKE', "%$search%")
            ->groupBy('phongbans.ma_phong', 'phongbans.ten_phong_ban', 'phongbans.mo_ta')
            ->paginate(8);

        if ($request->ajax()) {
            return [
                'datalist' => view('admin.phongban_data', ['phongbans' => $phongbans])->render(),
                'trang' => view('admin.trang', ['sotrang' => $phongbans->lastPage(), 'trang' => $phongbans->currentPage()])->render()
            ];
        }
        return view('admin.phongban', [
            'phongbans' => $phongbans,
            'title' => 'Phòng ban',
            'sotrang' => $phongbans->lastPage(),
            'trang' => $phongbans->currentPage(),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'ten_phong_ban' => 'required',
            'mo_ta' => 'required'
        ]);
        DB::table('phongbans')->insert([
            'ten_phong_ban' => $request->ten_phong_ban,
            'mo_ta' => $request->mo_ta
        ]);
        $content = Auth::user()->name . " đã thêm mới phòng ban: " . $request->ten_phong_ban . " !";
        $this->guithongbao($content);
        return 1;
    }

    public function savechange(Request $request)
    {
        $request->validate([
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
        $content = Auth::user()->name . " đã thay đổi phòng ban có mã phòng: " . $request->ma_phong . " !";
        $this->guithongbao($content);
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
        if (count($check_nv) > 0) {
            return count($check_nv);
        }
        DB::table('phongbans')->where('ma_phong', $request->ma_phong)->delete();
        $content = Auth::user()->name . " đã xóa phòng ban: " . $request->ten_phong_ban . " !";
        $this->guithongbao($content);
        return 0;
    }
    private function guithongbao($message)
    {
        try {
            event(new ThongbaoEvent($message));
        } catch (\Exception $e) {
        }
    }
}

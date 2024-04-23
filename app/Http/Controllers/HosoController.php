<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HosoController extends Controller
{
    public function index()
    {
        $congviecs = DB::table('congviecs')->join('hscvs','congviecs.ma_cong_viec','hscvs.ma_cong_viec')->get();
        $hosos = DB::table('hosos')->paginate(8);
        return view('admin.hoso', [
            'hosos' => $hosos,
            'congviecs'=> $congviecs,
            'title' => "Hồ sơ"
        ]);
    }
    public function create()
    {
       
        return view('admin.themhoso', [
            'title' => "Thêm nhân viên",
            
        ]);
    }
    public function store(Request $request)
    {

        $request->validate([
            'ten_ho_so' => 'required',
        ]);
        $name = Auth::user()->name;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $current_time = date('Y-m-d H:i:s');

        $ma_ho_so =  DB::table('hosos')->insertGetId([
            'ten_ho_so' => $request->ten_ho_so,
            'mo_ta' => $request->mo_ta,
            'trang_thai' => 0,
            'nguoi_tao' => $name,
            'nguoi_cap_nhat' => $name,
            'ngay_tao' => $current_time,
            'ngay_cap_nhat' => $current_time,
        ]);
        if ($request->tag != null) {
            foreach ($request->tag as $item) {
                DB::table('hscvs')->insert([
                    'ma_ho_so' => $ma_ho_so,
                    'ma_cong_viec' => $item
                ]);
            }
        }

        return redirect('/hoso')->with('success', 'Thêm thành công!');
    }
    public function tim(Request $request)
    {
        $tags = [];
        if ($search = $request->name) {
            $tags = DB::table('congviecs')->where('ten_cong_viec', 'LIKE', "%$search%")->get();
            return response()->json($tags);
        } else {
            $tags = DB::table('congviecs')->get();
            return response()->json($tags);
        }
    }
    public function edit($id)
    {
        $hoso = DB::table('hosos')->where('ma_ho_so',$id)->first();
        $congviecs = DB::table('hosos')->join('hscvs','hosos.ma_ho_so','hscvs.ma_ho_so')
        ->join('congviecs','hscvs.ma_cong_viec','congviecs.ma_cong_viec')
        ->where('hosos.ma_ho_so',$id)->get();


        return view('admin.detailhoso',[
            'hoso'=>$hoso,
            'congviecs'=>$congviecs,
            'title'=>"Chi tiết hồ sơ"
        ]);
    }
    public function savechange(Request $request)
    {
        $request->validate([
            'ma_ho_so'=>'required',
            'ten_ho_so'=>'required',        
        ]);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $current_time = date('Y-m-d H:i:s');
        DB::table('hosos')->where('ma_ho_so',$request->ma_ho_so)
        ->update([
            'ten_ho_so'=>$request->ten_ho_so,
            'mo_ta'=>$request->mo_ta,
            'nguoi_cap_nhat'=>Auth::user()->name,
            'ngay_cap_nhat'=>$current_time,
        ]);
        DB::table('hscvs')->where('ma_ho_so',$request->ma_ho_so)
        ->delete();
        if($request->tag != null)
        {
            foreach($request->tag as $item)
            {
                DB::table('hscvs')->insert([
                    'ma_ho_so'=>$request->ma_ho_so,
                    'ma_cong_viec'=>$item
                ]);
            }
        }
        return redirect('/hoso')->with('success','Cập nhật thành công!');

    }
    public function takehs(Request $request)
    {
        $tags = [];
        if ($search = $request->name) {
            $tags = DB::table('hosos')->where('ten_ho_so', 'LIKE', "%$search%")->get();
            return response()->json($tags);
        } else {
            $tags = DB::table('hosos')->get();
            return response()->json($tags);
        }
    }
}

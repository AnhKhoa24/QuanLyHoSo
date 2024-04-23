<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CongviecController extends Controller
{
    public function index(Request $request)
    {        
        $search = "";
        if($request->search)
        {
            $search = $request->search;
        }
        $congviecs = DB::table('congviecs')->where('ten_cong_viec','LIKE',"%$search%")->paginate(8);
        $nhanviens = DB::table('nhanviens')->join('nvcvs', 'nhanviens.ma_nhan_vien', 'nvcvs.ma_nhan_vien')->get();
        return view('admin.congviec', [
            'cvs' => $congviecs,
            'title' => "Công việc",
            'nvs' => $nhanviens,
            'search'=> $search,
        ]);
    }
    public function create()
    {
        return view('admin.themcongviec', [
            'title' => "Thêm công việc"
        ]);
    }
    public function takenhv(Request $request)
    {
        $tags = [];
        if ($search = $request->name) {
            $tags = DB::table('nhanviens')->where('ho_ten', 'LIKE', "%$search%")->get();
            return response()->json($tags);
        } else {
            $tags = DB::table('nhanviens')->get();
            return response()->json($tags);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'ten_cong_viec' => 'required',
            'uu_tien' => 'required',
            'ngay_het_han' => 'required'
        ]);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $current_time = date('Y-m-d H:i:s');
        $ma_cong_viec = DB::table('congviecs')->insertGetId([
            'ten_cong_viec' => $request->ten_cong_viec,
            'uu_tien' => $request->uu_tien,
            'ngay_het_han' => $request->ngay_het_han,
            'mo_ta_cong_viec' => $request->mo_ta_cong_viec,
            'trang_thai' => 0,
            'ngay_tao' => $current_time,
            'nguoi_tao' => Auth::user()->name,
        ]);
        if ($request->nv) {
            foreach ($request->nv as $item) {
                DB::table('nvcvs')->insert([
                    'ma_nhan_vien' => $item,
                    'ma_cong_viec' => $ma_cong_viec,
                ]);
            }
        }

        return redirect('/congviec')->with('success', "Thêm thành công!");
    }
    public function changestt(Request $request)
    {
        if ($request->stt != null && $request->stt == 0) {
            DB::table('congviecs')->where('ma_cong_viec', $request->ma_cong_viec)->update([
                'trang_thai' => 1,
            ]);
            return 1;
        } else if ($request->stt != null && $request->stt == 1) {
            DB::table('congviecs')->where('ma_cong_viec', $request->ma_cong_viec)->update([
                'trang_thai' => 0,
            ]);
            return 0;
        }
        else
        {
            return -1;
        }
    }
    public function xemthem($id)
    {
        $congviec = DB::table('congviecs')->where('ma_cong_viec',$id)->first();
        $nhanviens = DB::table('nhanviens')->join('nvcvs','nhanviens.ma_nhan_vien','nvcvs.ma_nhan_vien')->where('ma_cong_viec',$id)
        ->get();
        $hosos = DB::table('hosos')->join('hscvs','hosos.ma_ho_so','hscvs.ma_ho_so')->where('ma_cong_viec',$id)->get();
        return view('admin.congviecedit',[
            'congviec'=> $congviec,
            'title'=>"Cập nhật công việc",
            'nvselect2'=>$nhanviens,
            'hssl2'=> $hosos,
        ]);
    }

    public function savechange(Request $request)
    {
        $request->validate([
            'ma_cong_viec'=>'required',
            'ten_cong_viec'=>'required',
            'trang_thai'=>'required',
            'uu_tien'=>'required',
            'ngay_het_han'=>'required',
        ]);
       
        DB::table('congviecs')->where('ma_cong_viec',$request->ma_cong_viec)->update([
            'ten_cong_viec' => $request->ten_cong_viec,
            'trang_thai' => $request->trang_thai,
            'uu_tien' => $request->uu_tien,
            'ngay_het_han' => $request->ngay_het_han,
        ]);

        if($request->nv)
        {
            DB::table('nvcvs')->where('ma_cong_viec', $request->ma_cong_viec)->delete();
            foreach($request->nv as $item)
            {
                DB::table('nvcvs')->insert([
                    'ma_nhan_vien'=>$item,
                    'ma_cong_viec'=>$request->ma_cong_viec,
                ]);
            }
        }
        if($request->hs)
        {
            DB::table('hscvs')->where('ma_cong_viec',$request->ma_cong_viec)->delete();
            foreach($request->hs as $item)
            {
                DB::table('hscvs')->insert([
                    'ma_cong_viec'=> $request->ma_cong_viec,
                    'ma_ho_so'=>$item,
                ]);
            }
        }
        return redirect('/congviec/xemthem/'.$request->ma_cong_viec)->with('success','Cập nhật thành công!');
    }
    public function delete(Request $request)
    {
        $request->validate([
            'ma_cong_viec'=>'required',
        ]);

        DB::table('hscvs')->where('ma_cong_viec',$request->ma_cong_viec)->delete();
        DB::table('nvcvs')->where('ma_cong_viec',$request->ma_cong_viec)->delete();
        DB::table('congviecs')->where('ma_cong_viec',$request->ma_cong_viec)->delete();
        return redirect('/congviec')->with('success',"Xóa thành công!");
    }
}

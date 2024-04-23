<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
class NhanvienController extends Controller
{
    public function index()
    {
        $nhanviens = DB::table('nhanviens')
            ->join('phongbans', 'nhanviens.ma_phong', 'phongbans.ma_phong')
            ->paginate(8);
        return view('admin.nhanvien', [
            'nhanviens' => $nhanviens,
            'title' => "Danh sách nhân viên"
        ]);
    }
    public function findnv(Request $request)
    {
        $nhanvien = $nhanviens = DB::table('nhanviens')
            ->join('phongbans', 'nhanviens.ma_phong', 'phongbans.ma_phong')
            ->where('ma_nhan_vien', $request->ma_nhan_vien)
            ->first();
        return response([
            'data' => $nhanvien
        ], 200);
    }
    public function create()
    {
        $phongbans = DB::table('phongbans')
            ->get();
        return view('admin.createnhanvien', [
            'title' => 'Thêm nhân viên',
            'phongbans' => $phongbans
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'ho_ten' => 'required',
            'chuc_vu' => 'required|string',
            'dia_chi' => 'required',
            'sdt' => 'required',
            'ma_phong' => 'required',
            'avt' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:5120',
        ]);
        if ($request->hasFile('avt')) {
            $file = $request->file('avt');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);

            DB::table('nhanviens')->insert([
                'ho_ten' => $request->ho_ten,
                'chuc_vu' => $request->chuc_vu,
                'dia_chi' => $request->dia_chi,
                'sdt' => $request->sdt,
                'ma_phong' => $request->ma_phong,
                'avt' => $fileName,
            ]);
            return redirect('/nhanvien')->with('success', "Đã thêm thành công!!!");
        } else {
            return redirect('/nhanvien')->with('error', "Thêm thất bại, vui lòng thử lại!!!");
        }
    }
    public function profile($id)
    {
        $nhanvien = DB::table('nhanviens')->where('ma_nhan_vien', $id)->first();
        $phongbans = DB::table('phongbans')->get();
        
        $congviecs = DB::table('nhanviens')->join('nvcvs','nhanviens.ma_nhan_vien','nvcvs.ma_nhan_vien')
        ->join('congviecs','nvcvs.ma_cong_viec','congviecs.ma_cong_viec')
        ->where('nhanviens.ma_nhan_vien',$id)
        ->get();
        return view('admin.editnhanvien', [
            'nhanvien' => $nhanvien,
            'title' => "Thông tin nhân viên",
            'phongbans' => $phongbans,
            'congviecs' => $congviecs,
        ]);
    }
    public function avtchange(Request $request)
    {
        // Log::debug($request->all());
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            DB::table('nhanviens')->where('ma_nhan_vien', $request->ma_nhan_vien)->update([
                'avt' => $fileName
            ]);

            return $fileName;
        } else {
            return 0;
        }
    }
    public function savechange(Request $request)
    {
        $request->validate([
            'ma_nhan_vien'=>'required',
            'ho_ten'=>'required',
            'dia_chi'=>'required',
            'chuc_vu'=>'required',
            'sdt'=>'required',
            'ma_phong'=>'required'
        ]);

        DB::table('nhanviens')->where('ma_nhan_vien',$request->ma_nhan_vien)->update([
            'ho_ten'=>$request->ho_ten,
            'chuc_vu'=>$request->chuc_vu,
            'dia_chi'=>$request->dia_chi,
            'sdt'=>$request->sdt,
            'ma_phong'=>$request->ma_phong,
        ]);

        return redirect('/nhanvien/profile/'.$request->ma_nhan_vien)->with('success',"Đã cập nhật thành công!");

    }
    public function delete(Request $request)
    {
        $nhanviendel = DB::table('nhanviens')->where('ma_nhan_vien',$request->ma_nhan_vien)->first();
        if (File::exists(public_path('uploads/' . $nhanviendel->avt))) {
            File::delete(public_path('uploads/' . $nhanviendel->avt));
        } 
        DB::table('nvcvs')->where('ma_nhan_vien',$request->ma_nhan_vien)->delete();
        DB::table('nhanviens')->where('ma_nhan_vien',$request->ma_nhan_vien)->delete();
        return redirect('/nhanvien')->with('success','Xóa thành công!');
    }
}

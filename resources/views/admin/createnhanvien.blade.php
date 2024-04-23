@extends('layouts.layout')
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><a href="/nhanvien" class="text-muted fw-light">Nhân viên </a>/ thêm nhân viên </h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Thêm mới nhân viên</h5>
                        {{-- <small class="text-muted float-end">Default label</small> --}}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/nhanvien/create" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Họ tên</label>
                                <div class="col-sm-10">
                                    <input type="text" name="ho_ten" class="form-control" id="basic-default-name"
                                        placeholder="" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Chức vụ</label>
                                <div class="col-sm-10">
                                    <input type="text" name="chuc_vu" class="form-control" id="basic-default-name"
                                        placeholder="" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Địa chỉ</label>
                                <div class="col-sm-10">
                                    <input type="text" name="dia_chi" class="form-control" id="basic-default-name"
                                        placeholder="" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Số điện thoại</label>
                                <div class="col-sm-10">
                                    <input type="text" name="sdt" class="form-control" id="basic-default-name"
                                        placeholder="" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Phòng ban</label>
                                <div class="col-sm-10">
                                    <select name="ma_phong" class="form-select">
                                        @foreach ($phongbans as $phongban)
                                            <option value="{{ $phongban->ma_phong }}">{{ $phongban->ten_phong_ban }}</option>
                                        @endforeach 
                                      </select>
                                </div>
                                
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Ảnh</label>
                                <div class="col-sm-10">
                                    <input type="file" name="avt" class="form-control" id="basic-default-name"
                                        placeholder="" />
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

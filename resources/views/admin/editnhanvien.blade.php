@extends('layouts.layout')
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><a href="/nhanvien" class="text-muted fw-light">Nhân viên </a>/ thông tin chi tiết</h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-3">
                    <h5 class="card-header">Thông tin nhân viên</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="/uploads/{{ $nhanvien->avt }}" alt="user-avatar" class="d-block rounded"
                                height="100" width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Chọn ảnh khác</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input" hidden accept="image/*" />
                                    <input type="hidden" id="idnv" value="{{ $nhanvien->ma_nhan_vien }}">
                                </label>
                                <p class="text-muted mb-0">Tải lên ảnh của bạn</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="/nhanvien/savechange">
                            <input type="hidden" name="ma_nhan_vien" value="{{ $nhanvien->ma_nhan_vien }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Họ tên</label>
                                    <input class="form-control" type="text" name="ho_ten"
                                        value="{{ $nhanvien->ho_ten }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">Chức vụ</label>
                                    <input class="form-control" type="text" name="chuc_vu"
                                        value="{{ $nhanvien->chuc_vu }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">Địa chỉ</label>
                                    <input class="form-control" type="text" name="dia_chi"
                                        value="{{ $nhanvien->dia_chi }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="organization" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" name="sdt"
                                        value="{{ $nhanvien->sdt }}" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="country">Phòng ban</label>
                                    <select id="country" class="select2 form-select" name="ma_phong">
                                        @foreach ($phongbans as $phongban)
                                            <option value="{{ $phongban->ma_phong }}"
                                                {{ $phongban->ma_phong == $nhanvien->ma_phong ? 'selected' : '' }}>
                                                {{ $phongban->ten_phong_ban }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Lưu thay đổi</button>
                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>

                <div class="card mb-3">

                    <div class="card accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree">
                                Công việc
                            </button>
                        </h2>
                        <div id="accordionThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Công việc</th>
                                            <th>Trạng thái</th>
                                            <th>Người tạo</th>
                                            <th>Ngày tạo</th>
                                            <th>Ngày hết hạn</th>
                                    
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($congviecs as $congviec)
                                            <tr id="">
                                               <td>{{ $congviec->ten_cong_viec }}</td>
                                               <td>@if ($congviec->trang_thai == 0)
                                                   Chưa hoàn thành
                                               @else
                                                   Hoàn thành
                                               @endif</td>
                                               <td>{{ $congviec->nguoi_tao }}</td>
                                               <td>{{ date('d-m-Y', strtotime($congviec->ngay_tao)) }}</td>
                                               <td>{{ date('d-m-Y', strtotime($congviec->ngay_het_han)) }}</td>                    
                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="card">
                    <h5 class="card-header">Xóa nhân viên</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading fw-bold mb-1">Bạn có chắc muốn xóa bỏ nhân viên này?</h6>
                                <p class="mb-0">Các công việc do {{ $nhanvien->ho_ten }} đảm nhận, sẽ không còn giao cho nhân viên này
                                </p>
                            </div>
                        </div>
                        <form id="formAccountDeactivation" method="POST" action="/nhanvien/delete"
                            onsubmit="return confirmDelete(event)">
                            @csrf
                            <input type="hidden" name="ma_nhan_vien" value="{{ $nhanvien->ma_nhan_vien }}">
                            <button type="submit" class="btn btn-danger deactivate-account">Xóa nhân viên</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

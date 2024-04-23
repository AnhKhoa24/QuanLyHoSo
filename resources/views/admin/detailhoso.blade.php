@extends('layouts.layout')
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><a href="/hoso" class="text-muted fw-light">Hồ sơ </a>/ thông tin chi tiết</h4>


        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-3">
                    <h5 class="card-header">Chi tiết hồ sơ</h5>
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="/hoso/savechange">
                            <input type="hidden" name="ma_ho_so" value="{{ $hoso->ma_ho_so }}" id="mahoso">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Tên hồ sơ*</label>
                                    <input class="form-control" type="text" name="ten_ho_so"
                                        value="{{ $hoso->ten_ho_so }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Trạng thái hồ sơ (không thể chỉnh sửa )</label>
                                    <span @readonly(true) class="form-control">@if ($hoso->trang_thai == 0)
                                        Chưa hoàn thành
                                    @else
                                        Đã hoàn thành
                                    @endif</span>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Người tạo (không thể chỉnh sửa )</label>
                                    <span @readonly(true) class="form-control">{{ $hoso->nguoi_tao }}</span>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Ngày tạo (không thể chỉnh sửa )</label>
                                    <span @readonly(true) class="form-control">{{ date('d-m-Y', strtotime($hoso->ngay_tao)) }}</span>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Người cập nhật (không thể chỉnh sửa )</label>
                                    <span @readonly(true) class="form-control">{{ $hoso->nguoi_cap_nhat }}</span>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Ngày cập nhật (không thể chỉnh sửa )</label>
                                    <span @readonly(true) class="form-control">{{ date('d-m-Y', strtotime($hoso->ngay_cap_nhat)) }}</span>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Mô tả</label>
                                    <textarea name="mo_ta" class="form-control" cols="15">{{ $hoso->mo_ta }}</textarea>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Công việc của hồ sơ</label>

                                    <select name="tag[]" class="tags form-select" id="tags" multiple="multiple">

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
                                                <td>
                                                    @if ($congviec->trang_thai == 0)
                                                        Chưa hoàn thành
                                                    @else
                                                        Hoàn thành
                                                    @endif
                                                </td>
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
                    <h5 class="card-header">Xóa hồ sơ</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading fw-bold mb-1">Bạn có chắc muốn xóa bỏ hồ sơ này?</h6>
                                <p class="mb-0">Các công việc trên sẽ không nằm trong hồ sơ này nữa
                                </p>
                            </div>
                        </div>
                        <form method="POST" action="/hoso/delete"
                            onsubmit="return deleteHoso(event)">
                            @csrf
                            <input type="hidden" name="ma_nhan_vien" value="{{ $hoso->ma_ho_so }}">
                            <button type="submit" class="btn btn-danger deactivate-account">Xóa hồ sơ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

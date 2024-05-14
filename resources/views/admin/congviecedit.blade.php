@extends('layouts.layout')
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><a href="/congviec" class="text-muted fw-light">Công việc </a>/ thông tin công việc</h4>
        <div class="row">
            <div class="col-md-12">

                <div class="card mb-3">
                    <h5 class="card-header">Chi tiết công việc</h5>
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="/congviec/savechange">
                            @csrf
                            <input type="hidden" name="ma_cong_viec" value="{{ $congviec->ma_cong_viec }}"
                                id="ma_cong_viec">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Tên công việc*</label>
                                    <input class="form-control" type="text" name="ten_cong_viec"
                                        value="{{ $congviec->ten_cong_viec }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Trạng thái công việc</label>
                                    <select name="trang_thai" class="form-select">
                                        <option value="0" {{ $congviec->trang_thai == 0 ? "selected":"" }}>Chưa hoàn thành</option>
                                        <option value="1" {{ $congviec->trang_thai == 1 ? "selected":"" }} >Đã hoàn thành</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Người tạo (không thể chỉnh sửa )</label>
                                    <span @readonly(true) class="form-control">{{ $congviec->nguoi_tao }}</span>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Độ ưu tiên</label>
                                    <select name="uu_tien" class="form-select">
                                        <option value="1" {{ $congviec->uu_tien == 1 ? "selected":"" }}>Cấp 1</option>
                                        <option value="2" {{ $congviec->uu_tien == 2 ? "selected":"" }}>Cấp 2</option>
                                        <option value="3" {{ $congviec->uu_tien == 3 ? "selected":"" }}>Cấp 3</option>
                                        <option value="4" {{ $congviec->uu_tien == 4 ? "selected":"" }}>Cấp 4</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Ngày tạo (không thể chỉnh sửa )</label>
                                    <span @readonly(true)
                                        class="form-control">{{ date('d-m-Y', strtotime($congviec->ngay_tao)) }}</span>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Ngày hết hạn</label>
                                    <input type="date" class="form-control" name="ngay_het_han" value="{{ $congviec->ngay_het_han }}">
                                </div>

                                
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Nhân viên thực hiện</label>
                                    
                                    <select name="nv[]" class="nhanvs form-select" id="nhanvs" multiple="multiple">
                                        
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Hồ sơ</label>
                                    
                                    <select name="hs[]" class="hs form-select" id="hs" multiple="multiple">
                                        
                                    </select>
                                </div>
                                
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Mô tả</label>
                                    <textarea name="mo_ta_cong_viec" class="form-control" cols="15">{{ $congviec->mo_ta_cong_viec }}</textarea>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Lưu</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>

                <div class="card">
                    <h5 class="card-header">Xóa công việc</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading fw-bold mb-1">Bạn có chắc muốn xóa công việc này?</h6>
                                <p class="mb-0">Các công việc trên sẽ không nằm trong hồ sơ và phân công nhân viên
                                </p>
                            </div>
                        </div>
                        <form method="POST" action="/congviec/delete"
                            onsubmit="return deleteCv(event)">
                            @csrf
                            <input type="hidden" name="ma_cong_viec" value="{{ $congviec->ma_cong_viec }}">
                            <button type="submit" class="btn btn-danger deactivate-account">Xóa hồ sơ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <script>
        $(document).ready(function() {

            var hssl2 = [];
            @if (isset($hssl2) && !empty($hssl2))
                var hssl2 = {!! json_encode($hssl2) !!};
            @endif
            $('.hs').select2();
            $("#hs").select2({
                ajax: {
                    url: "{{ route('takehs') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            name: params.term,
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.ma_ho_so,
                                    text: item.ten_ho_so,
                                };
                            })
                        };

                    },
                },
                data: $.map(hssl2, function(option) {
                    return {
                        id: option.ma_ho_so,
                        text: option.ten_ho_so,
                        selected: true
                    };
                })
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            var nvselect2 = [];
            @if (isset($nvselect2) && !empty($nvselect2))
                var nvselect2 = {!! json_encode($nvselect2) !!};
            @endif
            $('.nhanvs').select2();
            $("#nhanvs").select2({
                ajax: {
                    url: "{{ route('takenhv') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            name: params.term,
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.ma_nhan_vien,
                                    text: item.ho_ten + "--" + item.ma_nhan_vien,
                                };
                            })
                        };

                    },
                },
                data: $.map(nvselect2, function(option) {
                    return {
                        id: option.ma_nhan_vien,
                        text: option.ho_ten+"--"+option.ma_nhan_vien,
                        selected: true
                    };
                })
            });
        });
    </script>
@endsection

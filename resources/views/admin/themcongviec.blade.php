@extends('layouts.layout')
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><a href="/congviec" class="text-muted fw-light">Công việc </a>/ tạo công việc</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Tạo công việc</h5>
                        {{-- <small class="text-muted float-end">Default label</small> --}}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/congviec/them">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Tên công việc*</label>
                                <div class="col-sm-10">
                                    <input type="text" name="ten_cong_viec" class="form-control"
                                        placeholder="Tên công việc" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Độ ưu tiên</label>
                                <div class="col-sm-10">
                                    <select name="uu_tien" class="form-select">
                                        <option value="1">Cấp 1</option>
                                        <option value="2">Cấp 2</option>
                                        <option value="3">Cấp 3</option>
                                        <option value="4">Cấp 4</option>
                                    </select>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Ngày hết hạn*</label>
                                <div class="col-sm-10">
                                    <input type="date" name="ngay_het_han" class="form-control"
                                        placeholder="Ngày hết hạn" />
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Nhân viên thực hiện</label>
                                <div class="col-sm-10">
                                    <select name="nv[]" class="nhanvs form-select" id="nhanvs" multiple="multiple">

                                    </select>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Mô tả công việc</label>
                                <div class="col-sm-10">
                                    <textarea name="mo_ta_cong_viec" rows="4" class="form-control" placeholder="Mô tả về công việc"></textarea>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Tạo công việc</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
    <script>
        $(document).ready(function() {
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
                                    text: item.ho_ten+"--"+item.ma_nhan_vien,
                                };
                            })
                        };

                    },
                }
            });
        });
    </script>

@endsection

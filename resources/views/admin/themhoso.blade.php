@extends('layouts.layout')
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><a href="/hoso" class="text-muted fw-light">Hồ sơ </a>/ tạo hồ sơ</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Tạo hồ sơ</h5>
                        {{-- <small class="text-muted float-end">Default label</small> --}}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/hoso/them">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Tên hồ sơ*</label>
                                <div class="col-sm-10">
                                    <input type="text" name="ten_ho_so" class="form-control" placeholder="Tên hồ sơ" />
                                </div>
                            </div>
                       

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Công việc của hồ sơ (có thể
                                    thêm sau )</label>
                                <div class="col-sm-10">
                                    <select name="tag[]" class="tags form-select" id="tags" multiple="multiple">
                                        
                                    </select>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Mô tả</label>
                                <div class="col-sm-10">
                                    <textarea name="mo_ta" rows="4" class="form-control" placeholder="Mô tả về hồ sơ"></textarea>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Tạo hồ sơ</button>
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

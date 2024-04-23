@extends('layouts.layout')
@section('content')
    
 <!-- Content -->

 <div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><a href="/phongban" class="text-muted fw-light">Phòng ban </a>/ thêm phòng ban </h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Thêm mới phòng ban</h5>
            {{-- <small class="text-muted float-end">Default label</small> --}}
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('store_pb') }}">
                @csrf
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Tên phòng ban</label>
                <div class="col-sm-10">
                  <input type="text" name="ten_phong_ban" class="form-control" id="basic-default-name" placeholder="" />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Mô tả</label>
                <div class="col-sm-10">
                  <input type="text" name="mo_ta" class="form-control" id="basic-default-name" placeholder="" />
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
@extends('layouts.layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> --}}


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


        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="card-title">Danh sách nhân viên</h5>
                <a href="/nhanvien/create">
                    <button type="button" class="btn btn-primary">Thêm</button>
                </a>

            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ảnh</th>
                            <th>Tên</th>
                            <th>Chức vụ</th>
                            <th>Địa chỉ</th>
                            <th>SĐT</th>
                            <th>
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($nhanviens as $nhanvien)
                            <tr id="{{ $nhanvien->ma_nhan_vien }}">
                                <td>{{ $nhanvien->ma_nhan_vien }}</td>
                                <td><img src="/uploads/{{ $nhanvien->avt }}" alt=""  class="w-px-40 h-auto rounded-circle"></td>
                                <td>{{ $nhanvien->ho_ten }}</td>
                                <td>{{ $nhanvien->chuc_vu }}</td>
                                <td>{{ $nhanvien->dia_chi }}</td>
                                <td>{{ $nhanvien->sdt }}</td>
                                <td>
                                    <a href="/nhanvien/profile/{{ $nhanvien->ma_nhan_vien }}">Xem thêm</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-centerx">

            </div>

            <nav aria-label="Page navigation">
                <ul class="pagination justify-content">
                    {{ $nhanviens->links('pagination::bootstrap-4') }}
                </ul>
            </nav>

        </div>



        <!--/ Basic Bootstrap Table -->
    @endsection

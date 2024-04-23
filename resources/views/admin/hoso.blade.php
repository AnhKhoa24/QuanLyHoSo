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
                <h5 class="card-title">Danh sách hồ sơ</h5>
                <a href="/hoso/them">
                    <button type="button" class="btn btn-primary">Thêm</button>
                </a>

            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mã hồ sơ</th>
                            <th>Tên hồ sơ</th>
                            <th>Trạng thái</th>
                            <th>Công việc</th>
                            <th>Ngày thay đổi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($hosos as $hoso)
                            <tr>
                                <td>{{ $hoso->ma_ho_so }}</td>
                                <td>{{ $hoso->ten_ho_so }}</td>
                                <td>
                                    @if ($hoso->trang_thai == 0)
                                        Chưa hoàn thành
                                    @else
                                        Hoàn thành
                                    @endif
                                </td>
                                <td>
                                    @foreach ($congviecs as $congviec)
                                        @if ($congviec->ma_ho_so == $hoso->ma_ho_so)
                                            {{ $congviec->ten_cong_viec }}
                                            <br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ date('d-m-Y', strtotime($hoso->ngay_cap_nhat)) }}</td>
                                <td>
                                    <a href="/hoso/more/{{ $hoso->ma_ho_so }}">See more</a>
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
                    {{ $hosos->links('pagination::bootstrap-4') }}
                </ul>
            </nav>

        </div>



        <!--/ Basic Bootstrap Table -->
    @endsection

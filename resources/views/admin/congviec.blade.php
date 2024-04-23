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
                <h5 class="card-title">Danh sách công việc</h5>
                <form class="d-flex" method="GET" action="/congviec">
                    <input name="search" value="{{ $search }}" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>



            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mã công việc</th>
                            <th>Tên công việc</th>
                            <th>Nhân viên th</th>
                            <th>Hoàn thành</th>
                            <th>Độ ưu tiên</th>
                            <th>Ngày hết hạn</th>
                            <th> <a href="/congviec/them">
                                    <button class="btn btn-outline-primary">Thêm</button>
                                </a></th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($cvs as $congviec)
                            <tr>
                                <td>{{ $congviec->ma_cong_viec }}</td>
                                <td>{{ $congviec->ten_cong_viec }}</td>
                                <td>
                                    @foreach ($nvs as $nhanvien)
                                        @if ($nhanvien->ma_cong_viec == $congviec->ma_cong_viec)
                                            {{ $nhanvien->ho_ten }}
                                            <br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if ($congviec->trang_thai == 0)
                                        <div class="form-check d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" id="defaultCheck6"
                                                onclick="checkCV({{ $congviec->ma_cong_viec }}, 0)" />
                                        </div>
                                    @else
                                        <div class="form-check d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" id="defaultCheck6"
                                                onclick="checkCV({{ $congviec->ma_cong_viec }}, 1)" checked />
                                        </div>
                                    @endif

                                </td>
                                <td>
                                    {{ $congviec->uu_tien }}
                                </td>
                                <td>{{ date('d-m-Y', strtotime($congviec->ngay_het_han)) }}</td>
                                <td>
                                    <a href="/congviec/xemthem/{{ $congviec->ma_cong_viec }}">
                                        Xem thêm
                                    </a>
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
                    {{ $cvs->links('pagination::bootstrap-4') }}
                </ul>
            </nav>

        </div>


        <script src="{{ asset('assets/congviec.js') }}"></script>
        <!--/ Basic Bootstrap Table -->
    @endsection

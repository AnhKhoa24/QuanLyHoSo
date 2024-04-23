@extends('layouts.layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> --}}

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="card-title">Danh sách phòng ban</h5>
                <a href="/phongban/create">
                    <button type="button" class="btn btn-primary">Thêm</button>
                </a>
                
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mã phòng</th>
                            <th>Tên phòng ban</th>
                            <th>Mô tả</th>
                            <th>Số nhân viên</th>
                            <th>
                               Thao tác
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($phongbans as $phongban)
                            <tr id="{{ $phongban->ma_phong }}">
                                <td>{{ $phongban->ma_phong }}</td>
                                <td>{{ $phongban->ten_phong_ban }}</td>
                                <td>{{ $phongban->mo_ta }}</td>
                                <td>{{ $phongban->soluongnv }}</td> 
                                <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" onclick="edit({{ $phongban->ma_phong }})"
                                          ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                        >
                                        <a class="dropdown-item" href="#" onclick="xoa({{ $phongban->ma_phong }})"
                                          ><i class="bx bx-trash me-1"></i> Delete</a
                                        >
                                      </div>
                                    </div>
                                  </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content">
                    {{ $phongbans->links('pagination::bootstrap-4') }}
                </ul>
            </nav>
        </div>
        
        <script src="{{ asset('assets/handle.js') }}"></script>
        <!--/ Basic Bootstrap Table -->
    @endsection

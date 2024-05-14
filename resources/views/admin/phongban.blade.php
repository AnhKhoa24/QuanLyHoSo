@extends('layouts.layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> --}}
        <style>
            /* CSS để tùy chỉnh giao diện của ô input */
            .swal2-input {
                margin-bottom: 10px;
                width: 100%;
                box-sizing: border-box;
                padding: 10px;
                font-size: 16px;
                border-radius: 5px;
                border: 1px solid #ccc;
            }
        </style>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="card-title">Danh sách phòng ban</h5>
                <div class="d-flex">
                    <input name="search" id="congviec-search" class="form-control me-2" type="search" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-outline-success" onclick="phongban_search()" type="button">Search</button>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table" id="data-list">
                   @include('admin.phongban_data')
                </table>
            </div>
            <br>
            <nav aria-label="Page navigation" id="trang">
                @include('admin.trang')
            </nav>
        </div>
        
        <script src="{{ asset('assets/handle.js') }}"></script>
        <!--/ Basic Bootstrap Table -->
    @endsection

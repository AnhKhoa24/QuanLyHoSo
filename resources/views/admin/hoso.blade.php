@extends('layouts.layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="card-title">Danh sách hồ sơ</h5>
                <div class="d-flex">
                    <input name="search" id="hoso-search" class="form-control me-2" type="search" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-outline-success" onclick="hoso_search()" type="button">Search</button>
                </div>

            </div>
            <div class="table-responsive text-nowrap">
                <table class="table" id="data-list">
                   @include('admin.hoso_data')
                </table>
            </div>
            <br>
            <nav aria-label="Page navigation" id="trang">
                @include('admin.trang')
            </nav>

        </div>

        <script src="{{ asset("assets/hoso.js") }}"></script>
        <!--/ Basic Bootstrap Table -->
    @endsection

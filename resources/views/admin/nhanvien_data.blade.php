<thead>
    <tr>
        <th>ID</th>
        <th>Ảnh</th>
        <th>Tên</th>
        <th>Chức vụ</th>
        <th>Địa chỉ</th>
        <th>SĐT</th>
        <th> <a href="/nhanvien/create">
            <button class="btn btn-outline-primary">Thêm</button>
        </a></th>
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
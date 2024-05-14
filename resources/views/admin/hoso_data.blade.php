<thead>
    <tr>
        <th>Mã hồ sơ</th>
        <th>Tên hồ sơ</th>
        <th>Trạng thái</th>
        <th>Công việc</th>
        <th>Ngày thay đổi</th>
        <th> <a href="/hoso/them">
            <button class="btn btn-outline-primary">Thêm</button>
        </a></th>
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
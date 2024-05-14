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
<tbody class="table-border-bottom-0" >
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
                        <input class="form-check-input" type="checkbox"
                            onclick="checkCV({{ $congviec->ma_cong_viec }})" />
                    </div>
                @endif
                @if ($congviec->trang_thai == 1)
                    <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input" type="checkbox"
                            onclick="checkCV({{ $congviec->ma_cong_viec }})" checked />
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
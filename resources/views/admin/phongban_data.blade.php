<thead>
    <tr>
        <th>Mã phòng</th>
        <th>Tên phòng ban</th>
        <th>Mô tả</th>
        <th>Số nhân viên</th>
        <th>
            <button class="btn btn-outline-primary" onclick="themphongban()">Thêm</button>
        </th>
    </tr>
</thead>
<tbody class="table-border-bottom-0" id="phongban-tbody">
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
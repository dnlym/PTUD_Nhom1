<?php
    include('clsbenhvien.php');
    class benhnhan extends hospital
    {
        public function  xemHoSoBenhAn($sql,$current_page,$inf_per_page)
        {
            $link=$this->connectdb();
            $ketqua=mysqli_query($link,$sql);
            if(mysqli_num_rows($ketqua)>0)
            {
                echo'<table class="table table-hover">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ tên</th>
                            <th>Bác sĩ khám</th>
                            <th>Chuẩn đoán</th>
                            <th>Kết luận</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                        </tr>
                        </thead>
                        <tbody>';
                $count=1 + ($current_page - 1) * $inf_per_page;;
                while($row=mysqli_fetch_array($ketqua))
                {
                    $maHoSo=$row['maHoSo'];
                    $chuanDoan=$row['chuanDoan'];
                    $ketLuan=$row['ketLuan'];
                    $trangThai=$row['trangThai'];
                    $ngayTaoHoSo=$row['ngayTaoHoSo'];
                    $maBenhNhan=$row['maBenhNhan'];
                    $maBacSi=$row['maBacSi'];
                    // Chuyển đổi chuỗi thành đối tượng DateTime
                    $date = DateTime::createFromFormat('Y-m-d', $ngayTaoHoSo);
                    // Định dạng lại thành DD/MM/YYYY
                    $formattedDate = $date->format('d/m/Y');
                    echo'<tr>
                            <td>'.$count.'</td>
                            <td>'.$row['hoTenBenhNhan'].'</td>
                            <td>'.$row['hoTenBacSi'].'</td>
                            <td>'.$chuanDoan.'</td>
                            <td>'.$ketLuan.'</td>
                            <td>'.$trangThai.'</td>
                            <td>'.$formattedDate.'</td>
                        </tr>';
                    $count++;
                }
                echo'</tbody>
                    </table>';
            }
            else {
                echo "Không có hồ sơ nào.";
            }
        }

        public function xemlichhenkham($sql,$current_page,$inf_per_page)
        {
            $link=$this->connectdb();
            $ketqua=mysqli_query($link,$sql);
            if(mysqli_num_rows($ketqua)>0)
            {
                echo'<table class="table table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Họ tên</th>
                                <th>Ngày khám</th>
                                <th>Giờ khám</th>
                                <th>Ngày tạo</th>
                                <th>Tình trạng</th>
                            </tr>
                        </thead>
                        <tbody>';
                    $count=1+($current_page -1 )* $inf_per_page;
                while($row=mysqli_fetch_array($ketqua))
                {
                    $maLichHen=$row['maLichHen'];
                    $hoTenBenhNhan=$row['hoTenBenhNhan'];
                    $ngayTaoLichHen=$row['ngayTaoLichHen'];
                    $ngayDatLich=$row['ngayDatLich'];
                    $gioDatLich=$row['gioDatLich'];
                    $trangThai=$row['trangThai'];  
                    $maBenhNhan=$row['maBenhNhan'];

                    $date_NgayDatLich = DateTime::createFromFormat('Y-m-d', $ngayDatLich);
                    $format_date_NgayDatLich= $date_NgayDatLich->format('d/m/Y');
                    
                    $date_ngayTaoLichHen=DateTime::createFromFormat('Y-m-d',$ngayTaoLichHen);
                    $format_date_ngayTaoLichHen=$date_ngayTaoLichHen->format('d/m/Y');

                    echo'
                        <tr>
                            <td>'.$count.'</td>
                            <td>'.$hoTenBenhNhan.'</td>
                            <td>'.$format_date_NgayDatLich.'</td>
                            <td>'.$gioDatLich.'</td>
                            <td>'.$format_date_ngayTaoLichHen.'</td>
                            <td>'.$trangThai.'</td>
                        </tr>
                        ';
                        $count++;
                }
                echo '</tbody>
                </table>';
            }
            else {
                echo "Không có lịch hẹn nào.";
            }

        }
        public function uploadfile($file_name, $tmp_name,$default_name, $folder)
        {
            if($file_name!=''){
                $new_name = $default_name; 
                $new_path = $folder . '/' . $new_name;  

                if (file_exists($new_path)) {
                    unlink($new_path); 
                }

                if (move_uploaded_file($tmp_name, $new_path)) {
                    return 1; 
                } else {
                    return 0; 
                }
            }
            
        }
        
    }
?>
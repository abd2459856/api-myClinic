<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=Export_Excel.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html>

<head>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        td {
            
            text-align: left;
        }

        th {
        
            text-align: center;
        }
    </style>
</head>

<body>
    <table style="width:100%">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>ชื่อเล่น</th>
                <th>เลขบัตรประชาชน</th>
                <th>เบอร์โทรศัพท์</th>
                <th>ประเภทแพ็กเกจ</th>
                <th>ค่าใช้จ่าย</th>
                <th>วันที่รักษา</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($Table as $r) { ?>
                <tr>
                    <td ><?php echo $i++; ?></td>
                    <td ><?php echo $r->Fisrtname; ?></td>
                    <td ><?php echo $r->Lastname; ?></td>
                    <td ><?php echo $r->Nickname; ?></td>
                    <td style='mso-number-format:"\@"'><?php echo $r->IDCard; ?></td>
                    <td style='mso-number-format:"\@"'><?php echo $r->tell; ?></td>
                    <td ><?php echo $r->treat_name; ?></td>
                    <td ><?php echo number_format($r->treat_price,2); ?></td>
                    <td ><?php echo date("Y-m-d", strtotime($r->Date_save)); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>
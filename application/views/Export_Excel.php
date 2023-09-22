<style>
    table,
    tr,
    td {
        border: 1px solid black;
    }
</style>
<table>
    <tr>
        <td>ลำดับ</td>
        <td>ชื่อ</td>
        <td>นามสกุล</td>
        <td>ชื่อเล่น</td>
        <td>เลขบัตรประชาชน</td>
        <td>เบอร์โทรศัพท์</td>
        <td>ประเภทแพ็กเกจ</td>
        <td>รายละเอียด</td>
    </tr>
    <?php $i = 1;
    foreach ($Table as $r) { ?>
        <tr>
            <td style='mso-number-format:"\@"'><?php echo $i++; ?></td>
            <td style='mso-number-format:"\@"'><?php echo $r->Fisrtname; ?></td>
            <td style='mso-number-format:"\@"'><?php echo $r->Lastname; ?></td>
            <td style='mso-number-format:"\@"'><?php echo $r->Nickname; ?></td>
            <td style='mso-number-format:"\@"'><?php echo $r->IDCard; ?></td>
            <td style='mso-number-format:"\@"'><?php echo $r->tell; ?></td>
            <td style='mso-number-format:"\@"'><?php echo $r->treat_name; ?></td>
            <td style='mso-number-format:"\@"'><?php echo $r->treatmens_detail; ?></td>
        </tr>
    <?php } ?>
</table>

<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=Export_Excel.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
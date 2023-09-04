<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class Get_model extends CI_Model
{


    public function get_doctor($data)
    {
        $WHERE ='';
        if ($data['textSearch']) {
            $WHERE ="And (ID_Doctor like '%$data[textSearch]%' or Fisrtname like '%$data[textSearch]%' or Lastname like '%$data[textSearch]%')";
        }else if($data['ID']){
            $WHERE ="AND ID = '$data[ID]' ";
        }
        $sql = "SELECT * FROM tbl_doctor Where 1=1 $WHERE ";
        return $this->db->query($sql)->result();
    }

    public function insert_doctor($data)
    {
        $sql = "INSERT INTO tbl_doctor
                (
                    Fisrtname
                    Lastname
                )
                VALUES
                (
                    '$data[Fisrtname]',
                    '$data[Lastname]'
                )";
        return $this->db->query($sql);
    }

    public function update_doctor($data)
    {
        $sql = "UPDATE tbl_doctor SET 
                Fisrtname = '$data[Fisrtname]',
                Lastname = '$data[Lastname]',
                ID_Doctor = '$data[ID_Doctor]'
                WHERE ID = '$data[ID]'";
        return $this->db->query($sql);
    }

    public function get_rendezvous($data)
    {
        $WHERE = "";
        if ($data['ID_nut'] != '') {
            $WHERE = "AND ID_nut = '$data[ID_nut]' ";
        }
        $sql = "SELECT * FROM tbl_appointment A 
        INNER JOIN tbl_customer C ON A.ID_customer = C.ID_customer 
        WHERE 1 $WHERE";
        return $this->db->query($sql)->result();
    }

    public function insert_rendezvous($data)
    {
        $sql = "INSERT INTO Tbl_rendezvous
                (
                    Savedate,
                    Startdate,
                    StartTime,
                    Doctor_ID,
                    Room_ID,
                    Section,
                    Remark,
                    Phone,
                    Patient_ID.
                )
                VALUES
                (
                    '$data[Savedate]',
                    '$data[Startdate]',
                    '$data[StartTime]',
                    '$data[Doctor_ID]',
                    '$data[Room_ID]',
                    '$data[Section]',
                    '$data[Remark]',
                    '$data[Phone]',
                    '$data[Patient_ID]'
                )";
        return $this->db->query($sql);
    }
    public function update_rendezvous($data)
    {
        $sql = "UPDATE Tbl_rendezvous 
                SET status = '$data[status]',
                    Savedate = '$data[Savedate]'
                WHERE 	id = '$data[id]' ";
    }
 
   
    public function get_customer($data)
    {
        $WHERE ='';
        if ($data['textSearch']) {
            $WHERE ="And (ID_customer like '%$data[textSearch]%' or Fisrtname like '%$data[textSearch]%' or Lastname like '%$data[textSearch]%')";
        }
        if ($data['IDCus']) {
            $WHERE ="And ID_customer = '$data[IDCus]'";
        }
        $sql = "SELECT * FROM tbl_customer Where 1=1 $WHERE ";
        return $this->db->query($sql)->result();
    }
    public function get_type()
    {
        $sql = "SELECT * FROM tbl_type";
        return $this->db->query($sql)->result();
    }
    public function insert_type($data)
    {
        $sql = "INSERT INTO tbl_type
                (
                    name
                )
                VALUES
                (
                    '$data[name]'
                )";
        return $this->db->query($sql);
    }
    public function update_type($data)
    {
        $sql = "UPDATE tbl_type set name = '$data[name]' where id = '$data [id]' ";
        return $this->db->query($sql);
    }
    public function insert_img($data)
    {
        $sql = "INSERT INTO tbl_image
                (
                    name,
                    id_type,
                    id_rendezvous,
                    id_customer,
                    filepath,
                    extension
                )
                VALUES
                (
                    '$data[name]',
                    '$data[id_type]',
                    '$data[id_rendezvous]',
                    '$data[id_customer]',
                    '$data[filepath]',
                    '$data[extension]'
                )";
        return $this->db->query($sql);
    }
    public function get_room($data)
    { 
        $WHERE='';
        if ($data['textSearch']) {
            $WHERE ="And (Room_Name like '%$data[textSearch]%' or Room_Detail like '%$data[textSearch]%' or Room_Number like '%$data[textSearch]%')";
        }
        $sql = "SELECT * FROM tbl_room_treat WHERE 1=1 $WHERE";
        return $this->db->query($sql)->result();
    }
    public function get_package($data)
    {
        $WHERE='';
        if ($data['textSearch']) {
            $WHERE ="And (treat_name like '%$data[textSearch]%' or treat_detail like '%$data[textSearch]%' )";
        }

        $sql = "SELECT * FROM `tbl_package_treat` WHERE 1=1 $WHERE";
        return $this->db->query($sql)->result();
    }
    public function get_appointment($data)
    {
        $WHERE ='';
        if ($data['textSearch']) {
            $WHERE .="And (N.ID_customer  like '%$data[textSearch]%' or C.Fisrtname like '%$data[textSearch]%' or C.Lastname like '%$data[textSearch]%'  or CONCAT( D.Fisrtname , ' ' ,D.Lastname) like '%$data[textSearch]%')";
        }
        if ($data['dateStart']) {
            $WHERE .="And DATE(N.Date_nut) >= '$data[dateStart]'";
        }
        if ($data['dateEnd']) {
            $WHERE .="And DATE(N.Date_nut) <= '$data[dateEnd]'";
        }

        $sql = "SELECT N.* 
        ,CONCAT(C.Fisrtname, ' ', C.Lastname) AS C_Name
        ,CONCAT( D.Fisrtname , ' ' ,D.Lastname) AS D_Name
        FROM tbl_appointment N 
        LEFT JOIN tbl_customer C ON N.ID_customer =C.ID_customer
        LEFT JOIN tbl_doctor D ON N.ID_doctor =D.ID
        WHERE 1=1 $WHERE";
        return $this->db->query($sql)->result();
    }
    public function profile_customer($data)
    {
        $sql = "SELECT C.Nickname,C.ID_customer,C.email,C.profile,C.tell, CONCAT(C.Fisrtname, ' ', C.Lastname) AS Name,(SELECT MAX(Date_nut) FROM `tbl_appointment` WHERE ID_customer =C.ID_customer) as Date_nut FROM `tbl_customer` C
        WHERE C.ID_customer =$data[IDCus];";
        return $this->db->query($sql)->result();
    }
    public function group_treatment($data)
    {
            $sql = "SELECT p.ID_treat,p.treat_name,COUNT(T.ID_treatments) Amount,MAX(T.Date_save) as Date_save,A.ID_nut
            FROM tbl_package_treat P
            INNER JOIN tbl_appointment A ON A.ID_package =p.ID_treat
            LEFT JOIN tbl_treatments T ON A.ID_package = T.ID_pagekage_treat
            WHERE A.ID_customer ='$data[IDCus]'
            GROUP BY p.ID_treat,p.treat_name
        ";
        return $this->db->query($sql)->result();
    }
    public function get_treatment($data)
    {
        $Where = '';
        if($data['ID_treat']){
            $Where = "AND T.ID_pagekage_treat = '$data[ID_treat]'";
        }
        
        $sql="SELECT p.ID_treat,p.treat_name,A.ID_nut,A.ID_package,A.ID_customer 
        FROM tbl_package_treat P 
        INNER JOIN tbl_appointment A ON A.ID_package = p.ID_treat 
        LEFT JOIN tbl_treatments T ON A.ID_package = T.ID_pagekage_treat 
        WHERE A.ID_customer = '$data[IDCus]'  $Where";
        // $sql = "SELECT p.ID_treat,p.treat_name,T.treatmens_detail,T.Date_save,A.ID_nut,A.ID_package,A.ID_customer
        // FROM tbl_package_treat P
        // INNER JOIN tbl_appointment A ON A.ID_package =p.ID_treat
        // LEFT JOIN tbl_treatments T ON A.ID_package = T.ID_pagekage_treat
        // WHERE A.ID_customer ='$data[IDCus]' $Where ";
        return $this->db->query($sql)->result();
    }

}

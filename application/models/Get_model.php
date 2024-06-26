<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class Get_model extends CI_Model
{


    public function get_doctor($data)
    {
        $WHERE = '';
        if ($data['textSearch']) {
            $WHERE = "And (ID_Doctor like '%$data[textSearch]%' or Fisrtname like '%$data[textSearch]%' or Lastname like '%$data[textSearch]%')";
        } else if ($data['ID']) {
            $WHERE = "AND ID = '$data[ID]' ";
        }
        if ($data['status']) {
            $WHERE = "And Status ='$data[status]'";
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
        $WHERE = '';
        if ($data['textSearch']) {
            $WHERE = "And (Customer_ID_Show like '%$data[textSearch]%' or Fisrtname like '%$data[textSearch]%' or Lastname like '%$data[textSearch]%' or tell like '%$data[textSearch]%' or Nickname like '%$data[textSearch]%')";
        }
        if ($data['IDCus']) {
            $WHERE = "And ID_customer = '$data[IDCus]'";
        }
        $sql = "SELECT c.*,(SELECT filepath FROM tbl_image i WHERE i.id_customer = c.ID_customer AND i.Pro = 1 ) as img_name 
        FROM tbl_customer c Where 1=1 $WHERE ";
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
        $WHERE = '';
        if ($data['textSearch']) {
            $WHERE = "And (Room_Name like '%$data[textSearch]%' or Room_Detail like '%$data[textSearch]%' or Room_Number like '%$data[textSearch]%')";
        }
        if ($data['status']) {
            $WHERE = "And Room_Status ='$data[status]'";
        }
        $sql = "SELECT * FROM tbl_room_treat WHERE 1=1 $WHERE";
        return $this->db->query($sql)->result();
    }
    public function get_package($data)
    {
        $WHERE = '';
        if ($data['textSearch']) {
            $WHERE = "And (treat_name like '%$data[textSearch]%' or treat_detail like '%$data[textSearch]%' )";
        }
        if ($data['status']) {
            $WHERE = "And treat_status ='$data[status]'";
        }

        $sql = "SELECT * FROM `tbl_package_treat` WHERE 1=1 $WHERE";
        return $this->db->query($sql)->result();
    }
    public function get_appointment($data)
    {
        $WHERE = '';
        if ($data['textSearch']) {
            $WHERE .= "And (C.Customer_ID_Show  like '%$data[textSearch]%' or C.Fisrtname like '%$data[textSearch]%' or C.Lastname like '%$data[textSearch]%'  or CONCAT( D.Fisrtname , ' ' ,D.Lastname) like '%$data[textSearch]%' OR C.tell like '%$data[textSearch]%')";
        }
        if ($data['dateStart']) {
            $WHERE .= "And DATE(N.Date_nut) >= '$data[dateStart]'";
        }
        if ($data['dateEnd']) {
            $WHERE .= "And DATE(N.Date_nut) <= '$data[dateEnd]'";
        }

        $sql = "SELECT N.* 
        ,CONCAT(C.Fisrtname, ' ', C.Lastname) AS C_Name
        ,CONCAT( D.Fisrtname , ' ' ,D.Lastname) AS D_Name
        ,C.tell
        ,C.Customer_ID_Show
        ,(SELECT filepath FROM tbl_image i WHERE i.id_customer = C.ID_customer AND i.Pro = 1 ) as img_name 
        FROM tbl_appointment N 
        LEFT JOIN tbl_customer C ON N.ID_customer =C.ID_customer
        LEFT JOIN tbl_doctor D ON N.ID_doctor =D.ID
        WHERE 1=1 $WHERE";
        return $this->db->query($sql)->result();
    }
    public function profile_customer($data)
    {
        $sql = "SELECT C.Nickname,C.ID_customer,C.email,C.profile,C.tell, CONCAT(C.Fisrtname, ' ', C.Lastname) AS Name,(SELECT MAX(Date_nut) FROM `tbl_appointment` WHERE ID_customer =C.ID_customer) as Date_nut,C.Customer_ID_Show FROM `tbl_customer` C
        WHERE C.ID_customer = '$data[IDCus]' ";
        return $this->db->query($sql)->result();
    }
    public function group_treatment($data)
    {
        $sql = "SELECT
                        P.ID_treat
                    ,P.treat_name
                    ,(SELECT COUNT(1) FROM tbl_treatments WHERE ID_pagekage_treat =P.ID_treat and ID_customer=AP.ID_customer) as Amount
                    ,(SELECT MAX(Date_save) FROM tbl_treatments WHERE ID_pagekage_treat =P.ID_treat and ID_customer=AP.ID_customer) as Date_save
                FROM tbl_package_treat P 
                INNER JOIN tbl_appointment AP ON P.ID_treat=AP.ID_package
                WHERE AP.ID_customer ='$data[IDCus]'
                GROUP BY  P.ID_treat,P.treat_name";
        // $sql = "SELECT p.ID_treat,p.treat_name,COUNT(T.ID_treatments) Amount,MAX(T.Date_save) as Date_save,A.ID_nut
        // FROM tbl_package_treat P
        // INNER JOIN tbl_appointment A ON A.ID_package =p.ID_treat
        // LEFT JOIN tbl_treatments T ON A.ID_package = T.ID_pagekage_treat
        // WHERE A.ID_customer ='$data[IDCus]'
        // GROUP BY p.ID_treat,p.treat_name";
        return $this->db->query($sql)->result();
    }
    public function get_treatment($data)
    {
        $Where = '';
        if ($data['ID_treat']) {
            $Where = "AND T.ID_pagekage_treat = '$data[ID_treat]'";
        }

        $sql = "SELECT
                T.ID_treatments
                ,T.ID_customer
                ,T.ID_pagekage_treat
                ,T.treatmens_detail
                ,T.Date_save
                ,P.treat_name
                ,p.ID_treat
            FROM tbl_treatments T
            LEFT JOIN tbl_package_treat P ON T.ID_pagekage_treat =P.ID_treat
            WHERE T.ID_customer = '$data[IDCus]'  $Where
            ORDER BY T.Date_save DESC";
        // $sql = "SELECT p.ID_treat,p.treat_name,T.treatmens_detail,T.Date_save,A.ID_nut,A.ID_package,A.ID_customer
        // FROM tbl_package_treat P
        // INNER JOIN tbl_appointment A ON A.ID_package =p.ID_treat
        // LEFT JOIN tbl_treatments T ON A.ID_package = T.ID_pagekage_treat
        // WHERE A.ID_customer ='$data[]' $Where ";
        return $this->db->query($sql)->result();
    }
    public function Export_Excel($ID_customer)
    {
        // $sql = "SELECT C.*,T.treatmens_detail,P.treat_name ,t.Date_save,p.treat_price 
        // FROM tbl_treatments T
        // INNER JOIN tbl_customer C ON T.ID_customer = C.ID_customer
        // INNER JOIN tbl_package_treat P ON T.ID_pagekage_treat = P.ID_treat
        // WHERE C.ID_customer = '$ID_customer'";
        $sql = "SELECT  aa.ID_customer,p.treat_price,p.treat_name,C.*,aa.Date_save
        FROM(
            SELECT T.ID_pagekage_treat,t.ID_customer,Max(t.Date_save) as Date_save
         FROM tbl_treatments t
         GROUP BY T.ID_pagekage_treat,t.ID_customer
        )aa
        INNER JOIN tbl_package_treat p on p.ID_treat =aa.ID_pagekage_treat
        INNER JOIN tbl_customer c on c.ID_customer =aa.ID_customer
        WHERE C.ID_customer = '$ID_customer'";

        return $this->db->query($sql)->result();
    }
    public function get_DataSummary($data)
    {
        $WHERE = "";
        if ($data['dateStart']) {
            $WHERE .= "And DATE(t.Date_save) >= '$data[dateStart]'";
        }
        if ($data['dateEnd']) {
            $WHERE .= "And DATE(t.Date_save) <= '$data[dateEnd]'";
        }
        $sql = "SELECT p.ID_treat,p.treat_name, SUM(p.treat_price) as cost,COUNT(1) amount
                FROM(
                    SELECT T.ID_pagekage_treat,t.ID_customer
                    FROM tbl_treatments t
                    WHERE 1=1 $WHERE 
                    GROUP BY T.ID_pagekage_treat,t.ID_customer
                )aa
                INNER JOIN tbl_package_treat p on p.ID_treat =aa.ID_pagekage_treat
                GROUP BY p.ID_treat,p.treat_name
                ORDER BY SUM(p.treat_price) DESC";
        // $sql = "SELECT p.ID_treat,p.treat_name ,SUM(p.treat_price) as cost,COUNT(1) amount
        // FROM tbl_package_treat p
        // INNER JOIN tbl_treatments t on p.ID_treat =t.ID_pagekage_treat
        // WHERE p.treat_status ='active' $WHERE
        // GROUP BY p.ID_treat,p.treat_name
        // ORDER BY SUM(p.treat_price) DESC";

        return $this->db->query($sql)->result();
    }
    public function get_DataMaxSummary($data)
    {
        $WHERE = "";
        if ($data['dateStart']) {
            $WHERE .= "And DATE(t.Date_save) >= '$data[dateStart]'";
        }
        if ($data['dateEnd']) {
            $WHERE .= "And DATE(t.Date_save) <= '$data[dateEnd]'";
        }

        $sql = "SELECT p.ID_treat,p.treat_name, SUM(p.treat_price) as cost,COUNT(1) amount
                FROM(
                    SELECT T.ID_pagekage_treat,t.ID_customer
                    FROM tbl_treatments t
                    WHERE 1=1 $WHERE 
                    GROUP BY T.ID_pagekage_treat,t.ID_customer
                )aa
                INNER JOIN tbl_package_treat p on p.ID_treat =aa.ID_pagekage_treat
                GROUP BY p.ID_treat,p.treat_name
                ORDER BY SUM(p.treat_price) DESC";
        // $sql = "SELECT p.ID_treat,p.treat_name ,SUM(p.treat_price) as cost,COUNT(1) amount
        // FROM tbl_package_treat p
        // INNER JOIN tbl_treatments t on p.ID_treat =t.ID_pagekage_treat
        // WHERE p.treat_status ='active' $WHERE
        // GROUP BY p.ID_treat,p.treat_name
        // ORDER BY SUM(p.treat_price) DESC";

        return $this->db->query($sql)->result();
    }
    public function get_DataHit($data)
    {
        $WHERE = "";
        if ($data['dateStart']) {
            $WHERE .= "And DATE(t.Date_save) >= '$data[dateStart]'";
        }
        if ($data['dateEnd']) {
            $WHERE .= "And DATE(t.Date_save) <= '$data[dateEnd]'";
        }
        $sql = "SELECT p.ID_treat,p.treat_name, SUM(p.treat_price) as cost,COUNT(1) amount
                FROM(
                    SELECT T.ID_pagekage_treat,t.ID_customer
                    FROM tbl_treatments t
                    WHERE 1=1 $WHERE 
                    GROUP BY T.ID_pagekage_treat,t.ID_customer
                )aa
                INNER JOIN tbl_package_treat p on p.ID_treat =aa.ID_pagekage_treat
                GROUP BY p.ID_treat,p.treat_name
                ORDER BY COUNT(p.ID_treat) DESC";
        // $sql = "SELECT p.ID_treat,p.treat_name ,SUM(p.treat_price) as cost,COUNT(1) amount
        // FROM tbl_package_treat p
        // INNER JOIN tbl_treatments t on p.ID_treat =t.ID_pagekage_treat
        // WHERE p.treat_status ='active' $WHERE
        // GROUP BY p.ID_treat,p.treat_name
        // ORDER BY COUNT(p.ID_treat) DESC";

        return $this->db->query($sql)->result();
    }
    public function get_DataMaxCostCustomer($data)
    {
        $WHERE = "";
        if ($data['dateStart']) {
            $WHERE .= "And DATE(t.Date_save) >= '$data[dateStart]'";
        }
        if ($data['dateEnd']) {
            $WHERE .= "And DATE(t.Date_save) <= '$data[dateEnd]'";
        }
        $sql = " SELECT  aa.ID_customer,c.Fisrtname,c.Lastname,SUM(p.treat_price) as cost ,COUNT(1) as amount
        FROM(
            SELECT T.ID_pagekage_treat,t.ID_customer
            FROM tbl_treatments t 
            WHERE 1=1 $WHERE 
            GROUP BY T.ID_pagekage_treat,t.ID_customer
        )aa
        INNER JOIN tbl_package_treat p on p.ID_treat =aa.ID_pagekage_treat
         INNER JOIN tbl_customer c on c.ID_customer =aa.ID_customer 
        GROUP BY aa.ID_customer,c.Fisrtname,c.Lastname";
        // $sql = "SELECT t.ID_customer,c.Fisrtname,c.Lastname,SUM(p.treat_price) as cost ,COUNT(1) as amount
        // FROM tbl_package_treat p
        // INNER JOIN tbl_treatments t on p.ID_treat =t.ID_pagekage_treat
        // INNER JOIN tbl_customer c on c.ID_customer =t.ID_customer 
        // WHERE p.treat_status ='active' $WHERE
        // GROUP BY t.ID_customer,c.Fisrtname,c.Lastname";

        return $this->db->query($sql)->result();
    }
    public function Export_ExcelAll($data)
    {
        $WHERE = "";
        if ($data['dateStart']) {
            $WHERE .= "And DATE(t.Date_save) >= '$data[dateStart]'";
        }
        if ($data['dateEnd']) {
            $WHERE .= "And DATE(t.Date_save) <= '$data[dateEnd]'";
        }
        // $sql = "SELECT C.*,T.treatmens_detail,P.treat_name ,t.Date_save,p.treat_price 
        // FROM tbl_treatments T
        // INNER JOIN tbl_customer C ON T.ID_customer = C.ID_customer
        // INNER JOIN tbl_package_treat P ON T.ID_pagekage_treat = P.ID_treat
        // WHERE C.ID_customer = '$ID_customer'";
        $sql = "SELECT  aa.ID_customer,p.treat_price,p.treat_name,C.*,aa.Date_save
        FROM(
            SELECT T.ID_pagekage_treat,t.ID_customer,Max(t.Date_save) as Date_save
         FROM tbl_treatments t
         WHERE 1=1 $WHERE 
         GROUP BY T.ID_pagekage_treat,t.ID_customer
        )aa
        INNER JOIN tbl_package_treat p on p.ID_treat =aa.ID_pagekage_treat
        INNER JOIN tbl_customer c on c.ID_customer =aa.ID_customer";

        return $this->db->query($sql)->result();
    }
}

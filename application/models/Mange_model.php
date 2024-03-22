<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class Mange_model extends CI_Model
{

    public function insert_doctor($data,$License)
    {
        $sql = "INSERT INTO tbl_doctor
                (
                    ID_Doctor,
                    Fisrtname,
                    Lastname,
                    Status,
                    License
                )
                VALUES
                (
                    '$data[ID_Doctor]',
                    '$data[Fisrtname]',
                    '$data[Lastname]',
                    '1',
                    '$License'
                )";
        return $this->db->query($sql);
    }

    public function delete_doctor($data)
    {
        $sql = "DELETE FROM tbl_doctor WHERE ID = '$data[ID]'";
        return $this->db->query($sql);
    }
    public function update_doctor($data)
    {
        $feild = '';
        if ($data['Fisrtname']) {
            $feild .= ",Fisrtname = '$data[Fisrtname]'";
        }
        if ($data['Lastname']) {
            $feild .= ",Lastname = '$data[Lastname]'";
        }
        if ($data['Status']|| $data['Status']==0) {
            $feild .= ",Status = '$data[Status]'";
        }
        if ($data['License']) {
            $feild .= ",License = '$data[License]'";
        }
        if ($data['ID_Doctor']) {
            $feild .= ",ID_Doctor = '$data[ID_Doctor]'";
        }

        $sql = "UPDATE tbl_doctor SET ID=ID
                $feild
                WHERE ID = '$data[ID]'";
        return $this->db->query($sql);
    }

    public function insert_customer($data)

    {
        if ($data['Customer_ID_Show']) {
            $Customer_ID_Show = $data['Customer_ID_Show'];
        } else {
            $Customer_ID_Show = '';
        }
        if ($data['IDCard']) {
            $IDCard = $data['IDCard'];
        } else {
            $IDCard = '';
        }
        if ($data['Nickname']) {
            $Nickname = $data['Nickname'];
        } else {
            $Nickname = '';
        }
        if ($data['Prefix']) {
            $Prefix = $data['Prefix'];
        } else {
            $Prefix = '';
        }
        if ($data['Fisrtname']) {
            $Fisrtname = $data['Fisrtname'];
        } else {
            $Fisrtname = '';
        }
        if ($data['Lastname']) {
            $Lastname = $data['Lastname'];
        } else {
            $Lastname = '';
        }
        if ($data['Birthday']) {
            $Birthday = $data['Birthday'];
        } else {
            $Birthday = '';
        }
        if ($data['gender']) {
            $gender = $data['gender'];
        } else {
            $gender = '';
        }
        if ($data['Occupation']) {
            $Occupation = $data['Occupation'];
        } else {
            $Occupation = '';
        }
        if ($data['Race']) {
            $Race = $data['Race'];
        } else {
            $Race = '';
        }
        if ($data['Nationality']) {
            $Nationality = $data['Nationality'];
        } else {
            $Nationality = '';
        }
        if ($data['religion']) {
            $religion = $data['religion'];
        } else {
            $religion = '';
        }
        if ($data['status_relationship']) {
            $status_relationship = $data['status_relationship'];
        } else {
            $status_relationship = '';
        }
        if ($data['weight']) {
            $weight = $data['weight'];
        } else {
            $weight = '';
        }
        if ($data['height']) {
            $height = $data['height'];
        } else {
            $height = '';
        }
        if ($data['address_number']) {
            $address_number = $data['address_number'];
        } else {
            $address_number = '';
        }
        if ($data['address_moo']) {
            $address_moo = $data['address_moo'];
        } else {
            $address_moo = '';
        }
        if ($data['address_village']) {
            $address_village = $data['address_village'];
        } else {
            $address_village = '';
        }
        if ($data['address_soi']) {
            $address_soi = $data['address_soi'];
        } else {
            $address_soi = '';
        }
        if ($data['address_road']) {
            $address_road = $data['address_road'];
        } else {
            $address_road = '';
        }
        if ($data['address_subdistrict']) {
            $address_subdistrict = $data['address_subdistrict'];
        } else {
            $address_subdistrict = '';
        }
        if ($data['address_district']) {
            $address_district = $data['address_district'];
        } else {
            $address_district = '';
        }
        if ($data['address_province']) {
            $address_province = $data['address_province'];
        } else {
            $address_province = '';
        }
        if ($data['postal']) {
            $postal = $data['postal'];
        } else {
            $postal = '';
        }
        if ($data['tell']) {
            $tell = $data['tell'];
        } else {
            $tell = '';
        }
        if ($data['email']) {
            $email = $data['email'];
        } else {
            $email = '';
        }
        $sql = "INSERT INTO Tbl_customer
        (
            IDCard,
            Nickname,
            Prefix,
            Fisrtname,
            Lastname,
            Birthday,
            gender,
            Occupation,
            Race,
            Nationality,
            religion,
            status_relationship,
            weight,
            height,
            address_number,
            address_moo,
            address_village,
            address_soi,
            address_road,
            address_subdistrict,
            address_district,
            address_province,
            postal,
            tell,
            email,
            Customer_ID_Show
        )
        VALUES
        (
            '$IDCard',
            '$Nickname',
            '$Prefix',
            '$Fisrtname',
            '$Lastname',
            '$Birthday',
            '$gender',
            '$Occupation',
            '$Race',
            '$Nationality',
            '$religion',
            '$status_relationship',
            '$weight',
            '$height',
            '$address_number',
            '$address_moo',
            '$address_village',
            '$address_soi',
            '$address_road',
            '$address_subdistrict',
            '$address_district',
            '$address_province',
            '$postal',
            '$tell',
            '$email',
            '$Customer_ID_Show'
        )";
        $this->db->query($sql);
        $sql2 = "SELECT LAST_INSERT_ID() as ID_customer";
        return $this->db->query($sql2)->result();
    }
    public function update_customer($data)
    {
        $sql = "UPDATE Tbl_customer SET 
            Nickname = '$data[Nickname]',
            Prefix = '$data[Prefix]',
            Fisrtname = '$data[Fisrtname]',
            Lastname = '$data[Lastname]',
            Birthday = '$data[Birthday]',
            gender = '$data[gender]',
            Occupation = '$data[Occupation]',
            Race = '$data[Race]',
            Nationality = '$data[Nationality]',
            religion = '$data[religion]',
            status_relationship = '$data[status_relationship]',
            weight = '$data[weight]',
            height = '$data[height]',
            address_number = '$data[address_number]',
            address_moo = '$data[address_moo]',
            address_village = '$data[address_village]',
            address_soi = '$data[address_soi]',
            address_road = '$data[address_road]',
            address_subdistrict = '$data[address_subdistrict]',
            address_district = '$data[address_district]',
            address_province = '$data[address_province]',
            postal = '$data[postal]',
            tell = '$data[tell]',
            email= '$data[email]',
            Customer_ID_Show = '$data[Customer_ID_Show]'
            WHERE ID_customer = '$data[ID_customer]'";
        return $this->db->query($sql);
    }
    public function delete_customer($data)
    {
        $sql = "DELETE FROM Tbl_customer WHERE ID_customer = '$data[ID]'";
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
                    extension,
                    Pro
                )
                VALUES
                (
                    '$data[name]',
                    '$data[id_type]',
                    '$data[id_rendezvous]',
                    '$data[id_customer]',
                    '$data[filepath]',
                    '$data[extension]',
                    '$data[Pro]'
                )";
        return $this->db->query($sql);
    }
    public function insert_appointment($data)
    {

        $sql = "INSERT INTO `tbl_appointment`(ID_customer
                                , ID_doctor
                                , Status_nut
                                , Date_nut
                                , Remark
                                , ID_room
                                , ID_package
                                , start_time
                                , end_time
                                ) 
                        VALUES (
                                  '$data[ID_customer]'
                                , '$data[ID_doctor]'
                                , 'นัดหมาย'
                                , '$data[Date_nut] $data[start_time]'
                                , '$data[Remark]'
                                , '$data[ID_room]'
                                , '$data[ID_package]'
                                , '$data[start_time]'
                                , '$data[end_time]')";
        return $this->db->query($sql);
    }
    public function update_appointment($data)
    {
        $feild = '';
        if ($data['Status_nut']) {
            $feild .= ",Status_nut = '$data[Status_nut]'";
        }
        if ($data['Date_nut']) {
            $feild .= ",Date_nut = '$data[Date_nut] $data[start_time]'";
        }
        if ($data['start_time']) {
            $feild .= ",start_time = '$data[start_time]'";
        }
        if ($data['end_time']) {
            $feild .= ",end_time = '$data[end_time]'";
        }
        if ($data['Remark']) {
            $feild .= ",Remark = '$data[Remark]'";
        }
        if ($data['Date_come']) {
            $feild .= ",Date_come = '$data[Date_come]'";
        }
        if ($data['Date_inspect']) {
            $feild .= ",Date_inspect = '$data[Date_inspect]'";
        }
        if ($data['Date_finish']) {
            $feild .= ",Date_finish = '$data[Date_finish]'";
        }


        $sql = "UPDATE tbl_appointment SET ID_nut = ID_nut
                $feild
                WHERE ID_nut = '$data[ID_nut]'";
        return $this->db->query($sql);
    }
    public function get_img($data)
    {
        $Where = '';
        if ($data['id_customer']) {
            $Where .= "AND id_customer = '$data[id_customer]' ";
        }
        if ($data['id_type']) {
            $Where .= "AND id_type = '$data[id_type]' ";
        }
        if ($data['id_rendezvous']) {
            $Where .= "AND id_rendezvous = '$data[id_rendezvous]' ";
        }

        $sql = "SELECT * FROM `tbl_image` WHERE 1  $Where ";
        return $this->db->query($sql)->result();
    }
    public function insert_treatmens($data)
    {
        $sql = "INSERT INTO tbl_treatments
                (
                    ID_customer,
                    ID_pagekage_treat,
                    treatmens_detail,
                    Date_save
                )
                VALUES
                (
                    '$data[ID_customer]',
                    '$data[ID_pagekage_treat]',
                    '$data[treatmens_detail]',
                    CURRENT_TIMESTAMP()
                )";
        $this->db->query($sql);
        $sql2 = " SELECT LAST_INSERT_ID() as ID_treatments";
        return $this->db->query($sql2)->result();
    }
    public function insert_package($data)
    {
        $sql = "INSERT INTO tbl_package_treat( treat_name, treat_detail, treat_status,treat_price) 
                VALUES ('$data[treat_name]','$data[treat_detail]','active','$data[treat_price]')";
        $this->db->query($sql);
    }
    public function update_package($data)
    {
        $feild = '';
        if ($data['treat_status']) {
            $feild .= ",treat_status = '$data[treat_status]'";
        }
        if ($data['treat_name']) {
            $feild .= ",treat_name = '$data[treat_name]'";
        }
        if ($data['treat_price']) {
            $feild .= ",treat_price = '$data[treat_price]'";
        }
        if ($data['treat_detail']||$data['treat_detail']=="") {
            $feild .= ",treat_detail = '$data[treat_detail]'";
        }
        echo $sql = "UPDATE tbl_package_treat SET ID_treat = ID_treat
        $feild
        WHERE ID_treat = '$data[ID_treat]'";
        $this->db->query($sql);
    }
    public function insert_roomtreat($data)
    {
        $sql = "INSERT INTO tbl_room_treat( Room_Number, Room_Name, Room_Detail,Room_Status) 
                VALUES ('$data[Room_Number]','$data[Room_Name]','$data[Room_Detail]','active')";
        $this->db->query($sql);
    }
    public function update_roomtreat($data)
    {
        $feild = '';
        if ($data['Room_Status']) {
            $feild .= ",Room_Status = '$data[Room_Status]'";
        }
        if ($data['Room_Number']) {
            $feild .= ",Room_Number = '$data[Room_Number]'";
        }
        if ($data['Room_Name']) {
            $feild .= ",Room_Name = '$data[Room_Name]'";
        }
        if ($data['Room_Detail']||$data['Room_Detail']=="") {
            $feild .= ",Room_Detail = '$data[Room_Detail]'";
        }
        $sql = "UPDATE tbl_room_treat SET ID_room = ID_room
        $feild
        WHERE ID_room = '$data[ID_room]' ";
        $this->db->query($sql);
    }
    public function Profile_deleteimg($ID_customer)
    {
        $sql = "DELETE FROM tbl_image WHERE Pro = '1' AND id_customer = '$ID_customer' ";
        $this->db->query($sql);
    }
    public function update_status($data)
    {
        $sql = "UPDATE tbl_customer SET status = '$data[status]' WHERE ID_customer = '$data[ID_customer]' ";
        $this->db->query($sql);
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class Mange_model extends CI_Model
{

    public function insert_doctor($data)
    {
        $sql = "INSERT INTO tbl_doctor
                (
                    ID_Doctor,
                    Fisrtname,
                    Lastname,
                    Status
                )
                VALUES
                (
                    '$data[ID_Doctor]',
                    '$data[Fisrtname]',
                    '$data[Lastname]',
                    '1'
                )";
        return $this->db->query($sql);
    }

    public function delete_doctor($data)
    {
        $sql = "DELETE FROM tbl_doctor WHERE id = '$data[ID]'";
        return $this->db->query($sql);
    }
    public function update_doctor($data)
    {
        $sql = "UPDATE tbl_doctor SET 
                Fisrtname = '$data[Fisrtname]',
                Lastname = '$data[Lastname]'
                WHERE ID_doctor = '$data[ID_doctor]'";
        return $this->db->query($sql);
    }

    public function insert_customer($data)
    {
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
            email
        )
        VALUES
        (
            '$data[IDCard]',
            '$data[Nickname]',
            '$data[Prefix]',
            '$data[Fisrtname]',
            '$data[Lastname]',
            '$data[Birthday]',
            '$data[gender]',
            '$data[Occupation]',
            '$data[Race]',
            '$data[Nationality]',
            '$data[religion]',
            '$data[status_relationship]',
            '$data[weight]',
            '$data[height]',
            '$data[address_number]',
            '$data[address_moo]',
            '$data[address_village]',
            '$data[address_soi]',
            '$data[address_road]',
            '$data[address_subdistrict]',
            '$data[address_district]',
            '$data[address_province]',
            '$data[postal]',
            '$data[tell]',
            '$data[email]'
        )";
        return $this->db->query($sql);
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
            email= '$data[email]'
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
        $feild='';
        if($data['Status_nut']){
            $feild .=",Status_nut = '$data[Status_nut]'";
        }
        if($data['Date_nut']){
            $feild .=",Date_nut = '$data[Date_nut] $data[start_time]'";
        }
        if($data['start_time']){
            $feild .=",start_time = '$data[start_time]'";
        }
        if($data['end_time']){
            $feild .=",end_time = '$data[end_time]'";
        }
        if($data['Remark']){
            $feild .=",Remark = '$data[Remark]'";
        }
        if($data['Date_come']){
            $feild .=",Date_come = '$data[Date_come]'";
        }
        if($data['Date_inspect']){
            $feild .=",Date_inspect = '$data[Date_inspect]'";
        }
        if($data['Date_finish']){
            $feild .=",Date_finish = '$data[Date_finish]'";
        }

        
        $sql = "UPDATE tbl_appointment SET ID_nut = ID_nut
                $feild
                WHERE ID_nut =$data[ID_nut]";
        return $this->db->query($sql);
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class Get_model extends CI_Model
{


    public function get_doctor()
    {
        $sql = "SELECT * FROM `tbl_doctor`";
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
                Lastname = '$data[Lastname]'
                WHERE ID_doctor = '$data[ID_doctor]'";
        return $this->db->query($sql);
    }

    public function get_rendezvous($data)
    {
        $WHERE = "";
        if ($data['id'] != '') {
            $WHERE = "AND id = '$data[id]' ";
        }
        $sql = "SELECT * FROM Tbl_rendezvous R
                INNER JOIN tbl_customer C ON R.Customer_ID = C.Customer_ID
                WHERE 1=1 " . $WHERE;
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
            profile
        )
        VALUES
        (
            '$data[IDCard]',
            '$data[Nickname]',
            '$data[Prefix]',
            '$data[Fisrtname]',
            '$data[Lastname]',
            '$data[Birthday]',
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
            '$data[email]',
            '$data[profile]'
        )";
        return $this->db->query($sql);
    }
    public function Update_customer($data)
    {
        $sql = "UPDATE Tbl_customer SET 
            Nickname = '$data[Nickname]',
            Prefix = '$data[Prefix]',
            Fisrtname = '$data[Fisrtname]',
            Lastname = '$data[Lastname]',
            Birthday = '$data[Birthday]',
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
            profile = '$data[profile]'
                WHERE Customer_ID = '$data[Customer_ID]'";
        return $this->db->query($sql);
    }
    public function get_customer($data)
    {
        $WHERE = "";
        if ($data['Customer_ID'] != '') {
            $WHERE = "AND Customer_ID = '$data[Customer_ID]' ";
        }
        $sql = "SELETE * FROM Tbl_customer WHERE 1=1" . $WHERE;
        return $this->db->query($sql)->result();
    }
    public function get_type()
    {
        $sql = "SELETE * FROM tbl_type";
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
}

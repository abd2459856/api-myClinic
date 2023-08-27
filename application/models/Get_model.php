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
}
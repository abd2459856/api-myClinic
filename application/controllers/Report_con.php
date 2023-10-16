<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


class Report_con extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Get_model');
        $this->load->model('Mange_model');
    }
    public function get_DataSummary()
    {

        $sumall = $this->Get_model->get_DataSummary($this->input->get());
        $maxsum = $this->Get_model->get_DataMaxSummary($this->input->get());
        $sumhit = $this->Get_model->get_DataHit($this->input->get());
        $maxcus = $this->Get_model->get_DataMaxCostCustomer($this->input->get());
        $newrespone = array(
            "sumall" => $sumall,
            "maxsum" => $maxsum,
            "sumhit" => $sumhit,
            "maxcus" => $maxcus,

        );

        http_response_code(200);
        echo json_encode(['status' => 'success', 'data' => $newrespone]);
    }
    public function Export_ExcelAll()
    {
        $data['Table'] = $this->Get_model->Export_ExcelAll($this->input->get());
        // print_r($data['Table']);
        $this->load->view("Export_Excel", $data);
    }
}

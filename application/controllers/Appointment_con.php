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


class Appointment_con extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Get_model');
        $this->load->model('Mange_model');
    }
    public function get_appointment()
    {

        $respone = $this->Get_model->get_appointment($this->input->get());
        http_response_code(200);
        echo json_encode(['status' => 'success', 'data' => $respone]);
    }
    public function insert_appointment()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $respone = $this->Mange_model->insert_appointment($post);
        http_response_code(200);
        echo json_encode(['status' => 'success', 'data' => $respone]);
    }
    public function update_appointment()
    {

        $post = json_decode(file_get_contents('php://input'), true);
        $respone = $this->Mange_model->update_appointment($post);
        http_response_code(200);
        echo json_encode(['status' => 'success', 'data' => '']);
    }
    public function delete_customer()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $this->Mange_model->delete_customer($post);
        http_response_code(200);
        echo json_encode(['status' => 'success', 'data' => '']);
    }
}

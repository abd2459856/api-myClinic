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


class Customer_con extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Get_model');
        $this->load->model('Mange_model');
    }
    public function get_customer()
    {

        $respone = $this->Get_model->get_customer($this->input->get());
        http_response_code(200);
        echo json_encode(['status' => 'success', 'data' => $respone]);
    }
    public function profile_customer()
    {

        $respone = $this->Get_model->profile_customer($this->input->get());
        http_response_code(200);
        echo json_encode(['status' => 'success', 'data' => $respone]);
    }
    public function insert_customer()
    {

        $filepath = date("Ydmhis");
        // for ($i = 0; $i < $this->input->post('index'); $i++) {
        // 	$nameArray = explode('.', $_FILES['fileLicense' . $i]['name']);
        // 	foreach ($nameArray as $row) {
        // 		$file_extension = $row;
        // 	}
        // 	$newnamefilepath = uniqid() . "_img_" . date('Ymd');
        // 	$nameproperty = $newnamefilepath . '.' . $file_extension;
        // 	move_uploaded_file($_FILES['fileLicense' . $i]['tmp_name'], 'fileUpload/' . $nameproperty);
        // 	$data = [
        // 		"name"=>$newnamefilepath,
        // 		"id_type"=>'',
        // 		"id_rendezvous"=>'',
        // 		"id_customer"=>$this->input->post("ID_Doctor"),
        // 		"filepath"=>$nameproperty,
        // 		"extension"=>$file_extension,
        // 	];
        // 	// $this->Mange_model->insert_img($data);
        // }
        $post = json_decode(file_get_contents('php://input'), true);
        $respone = $this->Mange_model->insert_customer($post);
        http_response_code(200);
        echo json_encode(['status' => 'success', 'data' => $respone]);
    }
    public function update_customer()
    {

        $post = json_decode(file_get_contents('php://input'), true);
        $respone = $this->Mange_model->update_customer($post);
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

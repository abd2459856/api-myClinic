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


class Treatment_con extends CI_Controller
{
    private $infoget = "";
    private $info = "";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Get_model');
        $this->load->model('Mange_model');
        $this->infoget = $this->input->get();
        $this->info = $this->input->post();
    }
    public function get_treatment()
    {
        $respone = $this->Get_model->get_treatment($this->input->get());
        http_response_code(200);
        echo json_encode(['status' => 'success', 'data' => $respone]);
    }
    public function group_treatment()
    {
        $respone = $this->Get_model->group_treatment($this->input->get());
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
    public function update_img()
    {
    }
    public function get_img()
    {
        $data = [
            "ID_customer" => $this->infoget['ID_customer'],
            "ID_nut" => $this->infoget['ID_nut'],
            "ID_package" => $this->infoget['ID_package'],
        ];
        $this->Mange_model->get_img($data);
        http_response_code(200);
        echo json_encode(['status' => 'success', 'data' => '']);
    }
    public function insert_treatmens()
    {
        $data = [
            "ID_pagekage_treat" => $this->info['ID_pagekage_treat'],
            "treatmens_detail" => $this->info['treatmens_detail'],
            "ID_customer" => $this->info['ID_customer']
        ];
        $id = $this->Mange_model->insert_treatmens($data);
        for ($i = 0; $i < $this->input->post('index'); $i++) {
            $nameArray = explode('.', $_FILES['Img' . $i]['name']);
            foreach ($nameArray as $row) {
                $file_extension = $row;
            }
            $newnamefilepath = uniqid() . "_img_" . date('Ymd');
            $nameproperty = $newnamefilepath . '.' . $file_extension;
            move_uploaded_file($_FILES['Img' . $i]['tmp_name'], 'fileUpload/' . $nameproperty);
            $data = [
                "name" => $newnamefilepath,
                "id_type" =>  $this->info['ID_pagekage_treat'],
                "id_rendezvous" => $id[0]->ID_treatments,
                "id_customer" => $this->info['ID_customer'],
                "filepath" => $nameproperty,
                "extension" => $file_extension,
            ];
            $this->Mange_model->insert_img($data);
        }
        http_response_code(200);
        echo json_encode(['status' => 'success', 'data' => '']);
    }
}

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


class ConfigCon extends CI_Controller
{
	private $info = "";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Get_model');
		$this->load->model('Mange_model');
		$this->info = $this->input->post();
	}
	public function get_doctor()
	{
		$respone = $this->Get_model->get_doctor($this->input->get());
		http_response_code(200);
		echo json_encode(['status' => 'success', 'data' => $respone]);
	}
	public function insert_doctor()
	{
		$filepath = date("Ydmhis");
		for ($i = 0; $i < $this->input->post('index'); $i++) {
			$nameArray = explode('.', $_FILES['fileLicense' . $i]['name']);
			foreach ($nameArray as $row) {
				$file_extension = $row;
			}
			$newnamefilepath = uniqid() . "_img_" . date('Ymd');
			$nameproperty = $newnamefilepath . '.' . $file_extension;
			move_uploaded_file($_FILES['fileLicense' . $i]['tmp_name'], 'fileUpload/' . $nameproperty);
			$filepath = 'fileUpload/' . $nameproperty;
			$data = [
				"name" => $newnamefilepath,
				"id_type" => '',
				"id_rendezvous" => '',
				"id_customer" => $this->input->post("ID_Doctor"),
				"filepath" => $filepath,
				"extension" => $file_extension,
				"Pro" => 0
			];
			$this->Mange_model->insert_img($data);
		}
		$respone = $this->Mange_model->insert_doctor($this->input->post(), $filepath);
		http_response_code(200);
		echo json_encode(['status' => 'success', 'data' => $respone]);
	}
	public function update_doctor()
	{
		$post = json_decode(file_get_contents('php://input'), true);
		$this->Mange_model->update_doctor($post);
		http_response_code(200);
		echo json_encode(array('result' => true));
	}
	public function delete_doctor()
	{
		// $post = json_decode(file_get_contents('php://input'), true);
		$data = [
			"ID" => $this->info['ID'],
		];
		$this->Mange_model->delete_doctor($data);
		http_response_code(200);
		echo json_encode(['status' => 'success', 'data' => '']);
	}
	public function get_room()
	{
		$respone = $this->Get_model->get_room($this->input->get());
		$newrespone = [];
		foreach ($respone as $r) {
			$newrespone[] = array(
				"ID_room" => $r->ID_room,
				"Room_Name" => $r->Room_Name,
				"Room_Number" => $r->Room_Number,
				"Room_Detail" => $r->Room_Detail,
				"Room_Status" => $r->Room_Status == 'active' ? true : false,
			);
		}
		http_response_code(200);
		echo json_encode(['status' => 'success', 'data' => $newrespone]);
	}
	public function get_package()
	{
		$respone = $this->Get_model->get_package($this->input->get());
		$newrespone = [];
		foreach ($respone as $r) {
			$newrespone[] = array(
				"ID_treat" => $r->ID_treat,
				"treat_name" => $r->treat_name,
				"treat_detail" => $r->treat_detail,
				"treat_price" => $r->treat_price,
				"treat_status" => $r->treat_status == 'active' ? true : false,
			);
		}
		http_response_code(200);
		echo json_encode(['status' => 'success', 'data' => $newrespone]);
	}
	public function insert_package()
	{
		$post = json_decode(file_get_contents('php://input'), true);
		$respone = $this->Mange_model->insert_package($post);
		http_response_code(200);
		echo json_encode(['status' => 'success', 'data' => $respone]);
	}
	public function update_package()
	{

		$post = json_decode(file_get_contents('php://input'), true);
		$respone = $this->Mange_model->update_package($post);
		http_response_code(200);
		echo json_encode(['status' => 'success', 'data' => $post]);
	}
	public function insert_roomtreat()
	{
		$post = json_decode(file_get_contents('php://input'), true);
		$respone =  $this->Mange_model->insert_roomtreat($post);
		http_response_code(200);
		echo json_encode(['status' => 'success', 'data' => '']);
	}
	public function update_roomtreat()
	{

		$post = json_decode(file_get_contents('php://input'), true);
		$respone = $this->Mange_model->update_roomtreat($post);
		http_response_code(200);
		echo json_encode(['status' => 'success', 'data' => '']);
	}
}

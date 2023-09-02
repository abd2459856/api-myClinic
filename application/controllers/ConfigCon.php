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
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Get_model');
		$this->load->model('Mange_model');
	}
	public function get_doctor()
	{
		if ($_SERVER["REQUEST_METHOD"] != 'GET') {
			http_response_code(404);
			return;
		}
		$respone = $this->Get_model->get_doctor($this->input->get());
		http_response_code(200);
		echo json_encode(['status' => 'success', 'data' => $respone]);
	}
	public function insert_doctor()
	{
		if ($_SERVER["REQUEST_METHOD"] != 'POST') {
			http_response_code(404);
			return;
		}
		$filepath = date("Ydmhis");
		// echo print($_FILES['fileLicense']['name']);
		// echo $name  = $_FILES['fileLicense']['name'];

		for ($i = 0; $i <  count($_FILES['fileLicense']['name']); $i++) {
			$config['allowed_types']  = 'jpg|jpeg|png|gif|pdf|xlsx|xls|zip|csv';
			$config['upload_path'] = 'fileUpload/';
			$config['file_name'] = $filepath;
			$this->load->library('upload', $config); //เรียกใช้ library upload สำหรับอัฟโหลดรูป
			$this->upload->initialize($config);
			$this->upload->do_upload('files');
		}


		// move_uploaded_file($_FILES['images']['tmp_name'], 'Img/' . $name);
		//  echo	count($_FILES['fileLicense']['name']);
		// if (isset($_FILES['fileLicense']['name'])) {
		// $config['allowed_types']  = 'jpg|jpeg|png|gif|pdf|xlsx|xls|zip|csv';
		// $config['upload_path'] = 'fileUpload/';
		// $config['file_name'] = $filepath;
		// $this->load->library('upload', $config); //เรียกใช้ library upload สำหรับอัฟโหลดรูป
		// $this->upload->initialize($config);
		// $this->upload->do_upload('files');
		// }
		// $_FILES['files']['name']
		$respone = $this->Mange_model->insert_doctor($this->input->post());
		http_response_code(200);
		echo json_encode(['status' => 'success', 'data' => $respone]);
	}
	public function delete_doctor()
	{

		if ($_SERVER["REQUEST_METHOD"] != 'POST') {
			http_response_code(404);
			return;
		}
		$post = json_decode(file_get_contents('php://input'), true);
		$this->Mange_model->delete_doctor($post);
		http_response_code(200);
		echo json_encode(['status' => 'success', 'data' => '']);
	}
}

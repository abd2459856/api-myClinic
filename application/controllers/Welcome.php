<?php
defined('BASEPATH') or exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/u$this->info['Type_Realty'];rls.html
	 */
	private $info = "";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Get_model');
		$this->info = $this->input->post();
	}

	public function index()
	{
	}
	public function get_doctor()
	{
		return $this->Get_model->get_doctor();
		http_response_code(200);
		echo json_encode(array('result' => true));
	}

	public function insert_doctor()
	{
		$data = [
			"Fisrtname" => $this->info['Fisrtname'],
			"Lastname" => $this->info['Lastname'],
		];
		$this->Get_model->insert_doctor($data);
		http_response_code(200);
		echo json_encode(array('result' => true));
	}

	public function update_doctor()
	{
		$data = [
			"Fisrtname" => $this->info['Fisrtname'],
			"Lastname" => $this->info['Lastname'],
			"ID_doctor" => $this->info['ID_doctor'],
		];
		$this->Get_model->insert_doctor($data);
		http_response_code(200);
		echo json_encode(array('result' => true));
	}

	public function insert_rendezvous()
	{

		$data = [
			"Savedate" => $this->info['Savedate'],
			"Startdate" => $this->info['Startdate'],
			"StartTime" => $this->info['StartTime'],
			"Doctor_ID" => $this->info['Doctor_ID'],
			"Room_ID" => $this->info['Room_ID'],
			"Section" => $this->info['Section'],
			"Remark" => $this->info['Remark'],
			"Phone" => $this->info['Phone'],
			"Patient_ID" => $this->info['Patient_ID'],
		];
		$this->Get_model->insert_rendezvous($data);
		http_response_code(200);
		echo json_encode(array('result' => true));
	}
	public function update_rendezvous()
	{
		$data = [
			"id" => $this->info['id'],
			"status" => $this->info['status'],
			"Savedate" => $this->info['Savedate'],
		];
		$this->Get_model->update_rendezvous($data);
		http_response_code(200);
		echo json_encode(array('result' => true));
	}

	public function insert_customer()
	{
		$data = [
			"IDCard" => $this->info['IDCard'],
			"Nickname" => $this->info['Nickname'],
			"Prefix" => $this->info['Prefix'],
			"Fisrtname" => $this->info['Fisrtname'],
			"Lastname" => $this->info['Lastname'],
			"Birthday" => $this->info['Birthday'],
			"Occupation" => $this->info['Occupation'],
			"Race" => $this->info['Race'],
			"Nationality" => $this->info['Nationality'],
			"religion" => $this->info['religion'],
			"status_relationship" => $this->info['status_relationship'],
			"weight" => $this->info['weight'],
			"height" => $this->info['height'],
			"address_number" => $this->info['address_number'],
			"address_moo" => $this->info['address_moo'],
			"address_village" => $this->info['address_village'],
			"address_soi" => $this->info['address_soi'],
			"address_road" => $this->info['address_road'],
			"address_subdistrict" => $this->info['address_subdistrict'],
			"address_district" => $this->info['address_district'],
			"address_province" => $this->info['address_province'],
			"postal" => $this->info['postal'],
			"tell" => $this->info['tell'],
			"email" => $this->info['email'],
			"profile" => $this->info['profile'],
		];
		$this->Get_model->insert_customer($data);
		http_response_code(200);
		echo json_encode(array('result' => true));
	}
	public function Update_customer()
	{
		$data = [
			"Customer_ID" => $this->info['Customer_ID'],
			"IDCard" => $this->info['IDCard'],
			"Nickname" => $this->info['Nickname'],
			"Prefix" => $this->info['Prefix'],
			"Fisrtname" => $this->info['Fisrtname'],
			"Lastname" => $this->info['Lastname'],
			"Birthday" => $this->info['Birthday'],
			"Occupation" => $this->info['Occupation'],
			"Race" => $this->info['Race'],
			"Nationality" => $this->info['Nationality'],
			"religion" => $this->info['religion'],
			"status_relationship" => $this->info['status_relationship'],
			"weight" => $this->info['weight'],
			"height" => $this->info['height'],
			"address_number" => $this->info['address_number'],
			"address_moo" => $this->info['address_moo'],
			"address_village" => $this->info['address_village'],
			"address_soi" => $this->info['address_soi'],
			"address_road" => $this->info['address_road'],
			"address_subdistrict" => $this->info['address_subdistrict'],
			"address_district" => $this->info['address_district'],
			"address_province" => $this->info['address_province'],
			"postal" => $this->info['postal'],
			"tell" => $this->info['tell'],
			"email" => $this->info['email'],
			"profile" => $this->info['profile'],
		];
		$this->Get_model->Update_customer($data);
		http_response_code(200);
		echo json_encode(array('result' => true));
	}
	public function get_customer()
	{
		return $this->Get_model->get_customer();
		http_response_code(200);
		echo json_encode(array('result' => true));
	}
	public function img()
	{
		for ($i = 0; $i < $this->info['index']; $i++) {
			$nameArray = explode('.', $_FILES['images' . $i]['name']);
			foreach ($nameArray as $row) {
				$file_extension = $row;
			}
			$newnamefilepath = uniqid() . "_img_" . date('Ymd');
			echo $nameproperty = $newnamefilepath . '.' . $file_extension;
			move_uploaded_file($_FILES['images' . $i]['tmp_name'], 'Img/' . $nameproperty);
			$data = [
				"name" => $nameproperty,
				"id_type" => '',
				"id_rendezvous" => '',
				"id_customer" => '',
				"filepath" => 'Img/' . $nameproperty,
				"extension" => $file_extension
			];
			$this->Get_model->insert_img($data);
		}
	}
	public function get_type()
	{
		return $this->Get_model->get_type();
		http_response_code(200);
		echo json_encode(array('result' => true));
	}
	public function insert_type()
	{
		$data = [
			"name" => $this->info['name']
		];
		$this->Get_model->insert_type($data);
		http_response_code(200);
		echo json_encode(array('result' => true));
	}
	public function update_type()
	{
		$data = [
			"id" => $this->info['id'],
			"name" => $this->info['name']
		];
		$this->Get_model->update_type($data);
		http_response_code(200);
		echo json_encode(array('result' => true));
	}
	public function insert_img()
	{
		$data = [
			"name" => $this->info['name'],
			"id_type" => $this->info['id_type'],
			"id_rendezvous" => $this->info['id_rendezvous'],
			"id_customer" => $this->info['id_customer'],
			"filepath" => $this->info['filepath'],
			"extension" => $this->info['extension'],
		];
		$this->Get_model->insert_img($data);
		http_response_code(200);
		echo json_encode(array('result' => true));
	}
}

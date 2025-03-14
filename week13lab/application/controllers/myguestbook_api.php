<?php

require_once 'Format.php';
require_once 'RestController.php';

use chriskacerguis\RestServer\RestController;

class MyGuestBook_Api extends RestController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('myguestbook_model');
	}

	//Get,Post,Put,Delete method
	//multiple guestbook
	function guestbooks_get()
	{
		$result = $this->myguestbook_model->read(null, null, null);

		if($result)
		{
			$this->response($result, 200);
		}

		else
		{
			$this->response(array('status' => 'failed'), 404);
		}
	}
//single guestbook
	function guestbook_get(){
		if(!$this->get("id")){
			$this->response(array('status' => 'failed'), 400);
		}
		$data=array('id'=>$this->get("id"));
		$result=$this->myguestbook_model->read($data,null,null);
		if($result){
			$this->response($result, 200);
		}else{
			$this->response(array('status' => 'failed'), 404);
		}
	}
	//user post a new guestbook
	function guestbook_post(){
		$postdate=date("Y-m-d",time());
		$posttime=date("H:i:s",time());
		$data=array(
			"user"=>$this->post("user"),
			"email"=>$this->post("email"),
			"comment"=>$this->post("comment"),
			"postdate"=>$postdate,
			"posttime"=>$posttime,
		);
		$result=$this->myguestbook_model->create($data);
		if($result===true){
			$this->response(array("status"=>"success"),200);
		}else{
			$this->response(array('status' => 'failed'), 200);
		}
	}

	//put method
	function guestbook_put(){
		if(!$this->get("id")){
			$this->response(array('status' => 'failed'), 400);
		}
		$postdate=date("Y-m-d",time());
		$posttime=date("H:i:s",time());
		$data=array(
			"user"=>$this->put("user"),
			"email"=>$this->put("email"),
			"comment"=>$this->put("comment"),
			"postdate"=>$postdate,
			"posttime"=>$posttime,
		);
		$result=$this->myguestbook_model->update($this->get('id'),$data);
		if($result===true){
			$this->response(array("status"=>"success"),200);
		}else{
			$this->response(array("status"=>"failed"),200);
		}
	}

	//delete method
	function guestbook_delete(){
		if(!$this->get("id")){
			$this->response(array('status' => 'failed'), 400);
		}
		$result=$this->myguestbook_model->delete($this->get('id'));
		if($result===true){
			$this->response(array("status"=>"success"),200);
		}else{
			$this->response(array('status' => 'failed'), 200);
		}
	}
}

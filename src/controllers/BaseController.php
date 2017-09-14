<?php
namespace Aspen\Controllers;

class BaseController {
	public $model;
	private $allowed_methods = ['GET','POST','PUT','DEL'];
	public function __construct() {
	}

	/**
	 * @param $id
	 * @param $msg
	 *
	 * @return mixed
	 */
	public function errorDispature($id,$msg){
		$payload['data']['error'] = $msg;
		switch ($id){
			case 'db':
				$payload['inner_code'] = 621005;
				break;
			case 'bad-request':
				$payload['inner_code'] = 621004;
				break;
			case 'path-not-exist':
				$payload['inner_code'] = 621404;
				break;
			case 'forbidden-methods':
				$payload['inner_code'] = 621304;
				break;
			case 'content-empty':
				$payload['inner_code'] = 621402;
				break;
			default:
				$payload['inner_code'] = 621005;
				break;
		}
		return $payload;
	}

	/**
	 * @param $controller
	 *
	 * @return array
	 */
	private function getAllowedMethods($controller){
		switch (str_replace('Aspen\\Controllers\\','',$controller)){
			case 'MumClubContactController':
				return array('GET');
			default:
				return [];
		}
	}

	/**
	 * @param $method
	 * @param $controller
	 *
	 * @return bool
	 */
	public function refuseHttpMethod($method,$controller) {
		/* check all */
		if(!in_array($method,$this->allowed_methods)){
			return true;
		}
		/* check for controllers */
		$controllerMethods = $this->getAllowedMethods($controller);
		if(!in_array($method,$controllerMethods)){
			return true;
		}
		return false;
	}
}
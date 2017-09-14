<?php
namespace Aspen\Controllers;
use Aspen\Models\MumClubContact;
use Exception;

class MumClubContactController extends BaseController {
	private $payload;
	public $mumClubContact;

	/**
	 * MumClubContactController constructor.
	 */
	public function __construct() {
		$this->mumClubContact = new MumClubContact();
	}
	/**
	 * @param $path
	 *
	 * @return
	 * $payload['payload']['data']
	 * $payload['inner_code'];
	 */
	public function index($path){
		$requestMethod = $_SERVER['REQUEST_METHOD'];
		if(!$this->refuseHttpMethod($requestMethod,get_class($this))) {
			$this->payload['payload']['data'] = null;
			$this->payload['inner_code'] = 621002;
			switch($path[3]){
				case '':
					$page = @$_GET['page'];
					$this->payload['data']['payload'] = $this->listMember($page);
					break;
				case 'id':
					try {
						if($path[4] == null || !intval($path[4])) {
							return $this->errorDispature('bad-request','id missing');
						} else {
							$id = intval($path[4]);
						}
						$user = $this->getMemberViaId($id);
						if($user == null) {
							return $this->errorDispature('content-empty','User not exist');
						} else {
							$this->payload['data']['payload'] = $this->getMemberViaId($id);
						}
					} catch (Exception $e){
						return $this->errorDispature('bad-request',$e->getMessage());
					}
					break;
				default:
					return $this->errorDispature('path-not-exist','Path not exist');
			}
			return $this->payload;
		} else {
			return $this->errorDispature('forbidden-methods','Method forbidden by server');
		}
	}

	/**
	 * @param int $page
	 *
	 * @return array
	 */
	public function listMember($page=1) {
		try{
			return $this->mumClubContact->all($page);
		} catch (Exception $e){
			$this->errorDispature('db',$e->getMessage());
		}
	}

	/**
	 * @param $id
	 *
	 * @return mixed|void
	 */
	private function getMemberViaId($id){
		try{
			return $this->mumClubContact->findById($id);
		} catch (Exception $e){
			$this->errorDispature('db',$e->getMessage());
		}
	}
}
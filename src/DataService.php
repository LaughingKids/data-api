<?php
namespace Aspen;
use Aspen\Controllers\MumClubContactController;
use Aspen\Controllers\FreeSamplesController;
use Aspen\Controllers\RootController;
use Aspen\Ultilities\Http\HttpResponse;

class DataService {
	private $responceHelper;
	private $apiEndpoint = 'data';
	/**
	 * DataApplication constructor.
	 * Call Wordpress hook functions when instance generated
	 */
	public function __construct() {
		$this->responceHelper = new HttpResponse();
		$this->routing();
//		add_filter('query_vars', array($this, 'add_query_vars'), 0);
//		add_action('parse_request', array($this, 'routing'), 0);
//		add_action('init', array($this, 'add_endpoint'), 0);
	}

	/**
	 * @param $vars
	 *
	 * @return array
	 */
	public function add_query_vars($vars){
		$vars[] = '__data';
		$vars[] = 'mumclub';
		$vars[] = 'freesample';
		return $vars;
	}

	/**
	 * hook function after init to add endpoint in wp_environment
	 */
	public function add_endpoint(){
		add_rewrite_rule('^data/','top');
	}

	/**
	 * hook function at parse_request point to response user request
	 * @return HTTP response with code.
	 */
	public function routing(){
		$request = explode('/',$_SERVER['REQUEST_URI']);
		$controller = new RootController();
		if($request['1'] != $this->apiEndpoint) {
			$data = $controller->errorDispature('path-not-exist','Path not exist');
			$this->responceHelper->response($data['inner_code'],$data['data']);
		} else {
			switch ($request['2']) {
				case 'mumclub':
					$controller = new MumClubContactController();
					$data = $controller->index($request);
					break;
				case 'freesample':
					$controller = new FreeSamplesController();
					$data = $controller->index($request);
					break;
				default:
					$data = $controller->errorDispature('path-not-exist','Path not exist');
					break;
			}
			$this->responceHelper->response($data['inner_code'],$data['data']);
		}
	}
}

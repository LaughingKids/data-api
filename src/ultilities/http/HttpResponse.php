<?php

namespace Aspen\Ultilities\Http;

class HttpResponse {
	const SUCCESS_CODE=200;
	const EMPTY_CONTENT=204;
	const NOT_FOUND_CODE=404;
	const UNAUTHORIZED_CODE=401;
	const BAD_REQUEST=400;
	const FORBIDDEN_ACTION=403;
	const UNALLOWMETHOD_ERROR=405;

	/**
	 * @param $innerCode
	 * @param $payload
	 * @return null but give user a http response
	 */
	public function response($innerCode,$payload) {
		$this->repsonseHeaderBuilder($innerCode);
		echo json_encode($payload);
		exit;
	}

	/**
	 * @param $innerCode
	 * no response just set response header
	 */
	private function repsonseHeaderBuilder($innerCode){
		switch($innerCode){
			case 621002:
				header("HTTP/1.1 " . self::SUCCESS_CODE . " " . $this->_getStatus(self::SUCCESS_CODE));
				break;
			case 621402:
				header("HTTP/1.1 " . self::EMPTY_CONTENT . " " . $this->_getStatus(self::EMPTY_CONTENT));
				break;
			case 621004:
				header("HTTP/1.1 " . self::BAD_REQUEST . " " . $this->_getStatus(self::BAD_REQUEST));
				break;
			case 621404:
				header("HTTP/1.1 " . self::NOT_FOUND_CODE . " " . $this->_getStatus(self::NOT_FOUND_CODE));
				break;
			case 621104:
				header("HTTP/1.1 " . self::UNAUTHORIZED_CODE . " " . $this->_getStatus(self::UNAUTHORIZED_CODE));
				break;
			case 621504:
				header("HTTP/1.1 " . self::UNALLOWMETHOD_ERROR . " " . $this->_getStatus(self::UNALLOWMETHOD_ERROR));
				break;
			case 621304:
				header("HTTP/1.1 " . self::FORBIDDEN_ACTION . " " . $this->_getStatus(self::FORBIDDEN_ACTION));
				break;
			default:
				header("HTTP/1.1 " . self::SUCCESS_CODE . " " . $this->_getStatus(self::SUCCESS_CODE));
				break;
		}
	}
	/**
	 * name different status code in http response header
	 * @param $statusCode
	 *
	 * @return string
	 */
	private function _getStatus($statusCode) {
		switch ($statusCode) {
			case 200: return "OK"; break;
			case 204: return "Empty Content"; break;
			case 400: return "Bad Request";break;
			case 401: return "Unauthorized"; break;
			case 403: return "Method Forbidden";break;
			case 404: return "Not Found";break;
			case 405: return "Method Not Allowed"; break;
			default:
				return "Internal Server Error"; break;
		}
	}
}
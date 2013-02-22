<?php


class SecuredCore {

	/**
	 * Associative array of controllers & actions that need
	 * to be served from HTTPS instead of regular HTTP.
	 *
	 * @var array
	 */
	public static $secured = array();

	/**
	 * Not Associative array of controllers & actions that allow
	 * to be served from both HTTPS and regular HTTP.
	 *
	 * @var array
	 */
	public static $allowed = array();

	/**
	 * If the current request comes through SSL,
	 * this variable is set to true.
	 *
	 * @var boolean True if request was made through SSL, false otherwise.
	 */
	public static $https = false;

    /**
	 * Whether or not to secure the entire admin route.
	 * Can take either string with the prefix, or an array of the prefixii?
	 *
	 * @var string || array
	 **/
	public static $prefixes = array();

	/**
	 * Whether or not to secure the entire admin route.
	 * Can take either string with the prefix, or an array of the prefixii?
	 *
	 * @param array $config associative array, keys are relevant to properties of this class
	 * @param array $options options array
	 *  -merge boolean whether config
	 **/
	public static function init(array $config, array $options = array()) {
		$options += array(
			'merge' => true,
			'httpsAutoDetect' => true,
		);
		foreach (array('secured', 'allowed', 'prefixes') as $var) {
			$value = isset($config[$var]) ? (array)$config[$var] : array();
			if ($options['merge']) {
				$value = Set::merge(self::$$var, $value);
			}
			self::$$var = $value;
		}

		if (isset($config['https'])) {
			self::$https = $config['https'];
		} elseif ($options['httpsAutoDetect']) {
			self::$https = self::isSSL();
		}
	}

	public static function isSSL() {
		return in_array(env('HTTPS'), array('on', true), true);
	}

	/**
	 * Determines whether the request (based on passed params)
	 *  is allowed or not.
	 *
	 * @param $params Parameters containing 'controller' and 'action'
	 * @return boolean allowed or not.
	 */

	public static function allowed($params) {
		if (array_key_exists($params['controller'], self::$allowed)) {
			$actions = (array)self::$allowed[$params['controller']];
			if ($actions === array('*')) {
				return true;
			}
			return (in_array($params['action'], $actions));
		}
		return false;
	}

	/**
	 * Determines whether the request (based on passed params)
	 * should be ssl'ed or not.
	 *
	 * @param array $params Parameters containing 'controller' and 'action'
	 * @return boolean True if request should be ssl'ed, false otherwise.
	 */
	public function ssled($params) {
		//Prefix Specific Check - allow securing of entire admin in one swoop
		if( !empty(self::$prefixes) &&  !empty($params['prefix']) && (in_array($params['prefix'], (array)self::$prefixes)) ) {
			return true;
		}

		if (self::$secured === '*' || self::$secured === array('*')) {
			return true;
		}

		if (!array_key_exists($params['controller'], self::$secured)) {
			return false;
		}

		$actions = (array)self::$secured[$params['controller']];

		if ($actions === array('*')) {
			return true;
		}
		return (in_array($params['action'], $actions));
	}

	public function url($url, $full = false) {
		if (is_string($url) && preg_match('#(^https?:)?//#', $url)) {
			return $url;
		}

		$originalUrl = $url;
		if (is_array($url)) {
			$url = Router::url($url);
			$url = preg_replace(sprintf('|^%s|', preg_quote(Router::getRequest()->base)), '', $url);
		}
		$url = Router::parse($url);

		if (!self::allowed($url)) {
			$secured = self::ssled($url);

			if ($secured && !self::$https) {
				return SecuredCore::sslUrl(Router::url($originalUrl));
			} elseif (!$secured && self::$https) {
				return SecuredCore::noSslUrl(Router::url($originalUrl));
			}
		}

		return Router::url($originalUrl, $full);
	}

	public static function sslUrl($relativeUrl) {
		$server = env('SERVER_NAME');
		return "https://$server{$relativeUrl}";
	}

	public static function noSslUrl($relativeUrl) {
		$server = env('SERVER_NAME');
		return "http://$server{$relativeUrl}";
	}

}
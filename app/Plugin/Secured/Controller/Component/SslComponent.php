<?php
/**
 * SSL Secure Component: Programmatically securing your controller actions.
 *
 * @copyright	  Copyright 2010, Plank Design (http://plankdesign.com)
 * @license		  http://opensource.org/licenses/mit-license.php The MIT License
 */

App::uses('SecuredCore', 'Secured.Lib');

/**
 * SSL Component
 *
 * This SSL component allows you to programmatically define which controller actions
 * should be served only under a secure HTTPS connection.
 *
 * Most of the time, this functionality is acheived through judicous use of rewrite/redirect
 * rules in your webserver (Apache, Lighhtpd, Nginx, etc.). Defining this logic in your webserver
 * is advantageous - an incorrect request never hits your application code, and it could be handled
 * by a proxy to ensure that your application servers are not bothered with requests they cannot serve.
 *
 * However, there are cases where the programmatic definition of which controllers & actions
 * is desirable - 1) during development, 2) sitations where you do not have access to .htaccess
 * or the webserver configuration, 3) when static definitions of secured URLs do not suffice.
 *
 * This very simple component attempts to address the above issues. See the README for a sample
 * configuration.
 *
 * @todo Test cases
 */

class SslComponent extends Component {

	/**
	 * Use this component if this variable is set to true.
	 *
	 * @var boolean Redirect if this is true, otherwise do nothing.
	 */
	public $autoRedirect = true;

	public function initialize($controller) {
		SecuredCore::init($this->settings);
	}

	public function startup($controller) {
		$this->controller = $controller;

		if ($controller->name === 'CakeError') {
			return;
		}

		if (SecuredCore::allowed($this->controller->request->params)) {
			return;
		}

		if ($this->autoRedirect === true) {
			$secured = SecuredCore::ssled($this->controller->request->params);

			if ($secured && !SecuredCore::$https) {
				$this->forceSSL();
			}
			elseif (!$secured && SecuredCore::$https) {
				$this->forceNoSSL();
			}
		}

	}

	/**
	 * Redirects current request to be SSL secured
	 *
	 * @return void
	 * @todo Make protocol & subdomain ('https' & 'www' configurable)
	 * @todo allow conditional passing of server identifier
	 */
	public function forceSSL() {
		$this->controller->redirect(SecuredCore::sslUrl($this->controller->here));
	}

	/**
	 * Symmetric method to forceSSL, which redirects the current
	 * executing request to non-SSL.
	 *
	 * @return void
	 * @todo Make protocol & subdomain ('https' & 'www' configurable)
	 * @todo allow conditional passing of server identifier
	 */
	public function forceNoSSL() {
		$this->controller->redirect(SecuredCore::noSslUrl($this->controller->here));
	}

	public function url($url, $full = false) {
		return SecuredCore::url($url, $full);
	}

	public function https($https = null) {
		if ($https === null) {
			return SecuredCore::$https;
		}

		return SecuredCore::$https = $https;
	}

	public function isSSL() {
		return SecuredCore::isSSL();
	}

}

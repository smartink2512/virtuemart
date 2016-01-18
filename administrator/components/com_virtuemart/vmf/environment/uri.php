<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Uri
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;


/**
 * JUri Class
 *
 * This class serves two purposes. First it parses a URI and provides a common interface
 * for the Joomla Platform to access and manipulate a URI.  Second it obtains the URI of
 * the current executing script from the server regardless of server.
 *
 * @since  11.1
 */
class vUri implements vIUri
{
	/**
	 * @var    JUri[]  An array of JUri instances.
	 * @since  11.1
	 */
	protected static $instances = array();

	/**
	 * @var    array  The current calculated base url segments.
	 * @since  11.1
	 */
	protected static $base = array();

	/**
	 * @var    array  The current calculated root url segments.
	 * @since  11.1
	 */
	protected static $root = array();

	/**
	 * @var    string  The current url.
	 * @since  11.1
	 */
	protected static $current;

	/**
	 * @var    string  Original URI
	 * @since  1.0
	 */
	protected $uri = null;

	/**
	 * @var    string  Protocol
	 * @since  1.0
	 */
	protected $scheme = null;

	/**
	 * @var    string  Host
	 * @since  1.0
	 */
	protected $host = null;

	/**
	 * @var    integer  Port
	 * @since  1.0
	 */
	protected $port = null;

	/**
	 * @var    string  Username
	 * @since  1.0
	 */
	protected $user = null;

	/**
	 * @var    string  Password
	 * @since  1.0
	 */
	protected $pass = null;

	/**
	 * @var    string  Path
	 * @since  1.0
	 */
	protected $path = null;

	/**
	 * @var    string  Query
	 * @since  1.0
	 */
	protected $query = null;

	/**
	 * @var    string  Anchor
	 * @since  1.0
	 */
	protected $fragment = null;

	/**
	 * @var    array  Query variable hash
	 * @since  1.0
	 */
	protected $vars = array();

	/**
	 * Constructor.
	 * You can pass a URI string to the constructor to initialise a specific URI.
	 *
	 * @param   string  $uri  The optional URI string
	 *
	 * @since   1.0
	 */
	public function __construct($uri = null)
	{
		if (!is_null($uri))
		{
			$this->parse($uri);
		}
	}

	/**
	 * Magic method to get the string representation of the URI object.
	 *
	 * @return  string
	 *
	 * @since   1.0
	 */
	public function __toString()
	{
		return $this->toString();
	}

	/**
	 * Returns full uri string.
	 *
	 * @param   array  $parts  An array specifying the parts to render.
	 *
	 * @return  string  The rendered URI string.
	 *
	 * @since   1.0
	 */
	public function toString(array $parts = array('scheme', 'user', 'pass', 'host', 'port', 'path', 'query', 'fragment'))
	{
		// Make sure the query is created
		$query = $this->getQuery();

		$uri = '';
		$uri .= in_array('scheme', $parts) ? (!empty($this->scheme) ? $this->scheme . '://' : '') : '';
		$uri .= in_array('user', $parts) ? $this->user : '';
		$uri .= in_array('pass', $parts) ? (!empty($this->pass) ? ':' : '') . $this->pass . (!empty($this->user) ? '@' : '') : '';
		$uri .= in_array('host', $parts) ? $this->host : '';
		$uri .= in_array('port', $parts) ? (!empty($this->port) ? ':' : '') . $this->port : '';
		$uri .= in_array('path', $parts) ? $this->path : '';
		$uri .= in_array('query', $parts) ? (!empty($query) ? '?' . $query : '') : '';
		$uri .= in_array('fragment', $parts) ? (!empty($this->fragment) ? '#' . $this->fragment : '') : '';

		return $uri;
	}

	/**
	 * Checks if variable exists.
	 *
	 * @param   string  $name  Name of the query variable to check.
	 *
	 * @return  boolean  True if the variable exists.
	 *
	 * @since   1.0
	 */
	public function hasVar($name)
	{
		return array_key_exists($name, $this->vars);
	}

	/**
	 * Returns a query variable by name.
	 *
	 * @param   string  $name     Name of the query variable to get.
	 * @param   string  $default  Default value to return if the variable is not set.
	 *
	 * @return  array   Query variables.
	 *
	 * @since   1.0
	 */
	public function getVar($name, $default = null)
	{
		if (array_key_exists($name, $this->vars))
		{
			return $this->vars[$name];
		}

		return $default;
	}

	/**
	 * Returns flat query string.
	 *
	 * @param   boolean  $toArray  True to return the query as a key => value pair array.
	 *
	 * @return  string   Query string.
	 *
	 * @since   1.0
	 */
	public function getQuery($toArray = false)
	{
		if ($toArray)
		{
			return $this->vars;
		}

		// If the query is empty build it first
		if (is_null($this->query))
		{
			$this->query = self::buildQuery($this->vars);
		}

		return $this->query;
	}

	/**
	 * Get URI scheme (protocol)
	 * ie. http, https, ftp, etc...
	 *
	 * @return  string  The URI scheme.
	 *
	 * @since   1.0
	 */
	public function getScheme()
	{
		return $this->scheme;
	}

	/**
	 * Get URI username
	 * Returns the username, or null if no username was specified.
	 *
	 * @return  string  The URI username.
	 *
	 * @since   1.0
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * Get URI password
	 * Returns the password, or null if no password was specified.
	 *
	 * @return  string  The URI password.
	 *
	 * @since   1.0
	 */
	public function getPass()
	{
		return $this->pass;
	}

	/**
	 * Get URI host
	 * Returns the hostname/ip or null if no hostname/ip was specified.
	 *
	 * @return  string  The URI host.
	 *
	 * @since   1.0
	 */
	public function getHost()
	{
		return $this->host;
	}

	/**
	 * Get URI port
	 * Returns the port number, or null if no port was specified.
	 *
	 * @return  integer  The URI port number.
	 *
	 * @since   1.0
	 */
	public function getPort()
	{
		return (isset($this->port)) ? $this->port : null;
	}

	/**
	 * Gets the URI path string.
	 *
	 * @return  string  The URI path string.
	 *
	 * @since   1.0
	 */
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * Get the URI archor string
	 * Everything after the "#".
	 *
	 * @return  string  The URI anchor string.
	 *
	 * @since   1.0
	 */
	public function getFragment()
	{
		return $this->fragment;
	}

	/**
	 * Checks whether the current URI is using HTTPS.
	 *
	 * @return  boolean  True if using SSL via HTTPS.
	 *
	 * @since   1.0
	 */
	public function isSSL()
	{
		return $this->getScheme() == 'https' ? true : false;
	}

	/**
	 * Build a query from a array (reverse of the PHP parse_str()).
	 *
	 * @param   array  $params  The array of key => value pairs to return as a query string.
	 *
	 * @return  string  The resulting query string.
	 *
	 * @see     parse_str()
	 * @since   1.0
	 */
	protected static function buildQuery(array $params)
	{
		return urldecode(http_build_query($params, '', '&'));
	}

	/**
	 * Parse a given URI and populate the class fields.
	 *
	 * @param   string  $uri  The URI string to parse.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   1.0
	 */
	protected function parse($uri)
	{
		// Set the original URI to fall back on
		$this->uri = $uri;

		/*
		 * Parse the URI and populate the object fields. If URI is parsed properly,
		 * set method return value to true.
		 */
		//if(!class_exists('UriHelper')) require(VMPATH_ADMIN. DS. 'vmf' .DS. 'environment' .DS. 'UriHelper.php');
		$parts = self::parse_url($uri);

		$retval = ($parts) ? true : false;

		// We need to replace &amp; with & for parse_str to work right...
		if (isset($parts['query']) && strpos($parts['query'], '&amp;'))
		{
			$parts['query'] = str_replace('&amp;', '&', $parts['query']);
		}

		$this->scheme   = isset($parts['scheme']) ? $parts['scheme'] : null;
		$this->user     = isset($parts['user']) ? $parts['user'] : null;
		$this->pass     = isset($parts['pass']) ? $parts['pass'] : null;
		$this->host     = isset($parts['host']) ? $parts['host'] : null;
		$this->port     = isset($parts['port']) ? $parts['port'] : null;
		$this->path     = isset($parts['path']) ? $parts['path'] : null;
		$this->query    = isset($parts['query']) ? $parts['query'] : null;
		$this->fragment = isset($parts['fragment']) ? $parts['fragment'] : null;

		// Parse the query
		if (isset($parts['query']))
		{
			parse_str($parts['query'], $this->vars);
		}

		return $retval;
	}

	/**
	 * Does a UTF-8 safe version of PHP parse_url function
	 *
	 * @param   string  $url  URL to parse
	 *
	 * @return  mixed  Associative array or false if badly formed URL.
	 *
	 * @see     http://us3.php.net/manual/en/function.parse-url.php
	 * @since   1.0
	 */
	public static function parse_url($url)
	{
		$result = false;

		// Build arrays of values we need to decode before parsing
		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "$", ",", "/", "?", "#", "[", "]");

		// Create encoded URL with special URL characters decoded so it can be parsed
		// All other characters will be encoded
		$encodedURL = str_replace($entities, $replacements, urlencode($url));

		// Parse the encoded URL
		$encodedParts = parse_url($encodedURL);

		// Now, decode each value of the resulting array
		if ($encodedParts)
		{
			foreach ($encodedParts as $key => $value)
			{
				$result[$key] = urldecode(str_replace($replacements, $entities, $value));
			}
		}

		return $result;
	}

	/**
	 * Resolves //, ../ and ./ from a path and returns
	 * the result. Eg:
	 *
	 * /foo/bar/../boo.php	=> /foo/boo.php
	 * /foo/bar/../../boo.php => /boo.php
	 * /foo/bar/.././/boo.php => /foo/boo.php
	 *
	 * @param   string  $path  The URI path to clean.
	 *
	 * @return  string  Cleaned and resolved URI path.
	 *
	 * @since   1.0
	 */
	protected function cleanPath($path)
	{
		$path = explode('/', preg_replace('#(/+)#', '/', $path));

		for ($i = 0, $n = count($path); $i < $n; $i++)
		{
			if ($path[$i] == '.' || $path[$i] == '..')
			{
				if (($path[$i] == '.') || ($path[$i] == '..' && $i == 1 && $path[0] == ''))
				{
					unset($path[$i]);
					$path = array_values($path);
					$i--;
					$n--;
				}
				elseif ($path[$i] == '..' && ($i > 1 || ($i == 1 && $path[0] != '')))
				{
					unset($path[$i]);
					unset($path[$i - 1]);
					$path = array_values($path);
					$i -= 2;
					$n -= 2;
				}
			}
		}

		return implode('/', $path);
	}

	/**
	 * Adds a query variable and value, replacing the value if it
	 * already exists and returning the old value.
	 *
	 * @param   string  $name   Name of the query variable to set.
	 * @param   string  $value  Value of the query variable.
	 *
	 * @return  string  Previous value for the query variable.
	 *
	 * @since   1.0
	 */
	public function setVar($name, $value)
	{
		$tmp = isset($this->vars[$name]) ? $this->vars[$name] : null;

		$this->vars[$name] = $value;

		// Empty the query
		$this->query = null;

		return $tmp;
	}

	/**
	 * Removes an item from the query string variables if it exists.
	 *
	 * @param   string  $name  Name of variable to remove.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function delVar($name)
	{
		if (array_key_exists($name, $this->vars))
		{
			unset($this->vars[$name]);

			// Empty the query
			$this->query = null;
		}
	}

	/**
	 * Sets the query to a supplied string in format:
	 * foo=bar&x=y
	 *
	 * @param   mixed  $query  The query string or array.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function setQuery($query)
	{
		if (is_array($query))
		{
			$this->vars = $query;
		}
		else
		{
			if (strpos($query, '&amp;') !== false)
			{
				$query = str_replace('&amp;', '&', $query);
			}

			parse_str($query, $this->vars);
		}

		// Empty the query
		$this->query = null;
	}

	/**
	 * Set URI scheme (protocol)
	 * ie. http, https, ftp, etc...
	 *
	 * @param   string  $scheme  The URI scheme.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function setScheme($scheme)
	{
		$this->scheme = $scheme;
	}

	/**
	 * Set URI username.
	 *
	 * @param   string  $user  The URI username.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function setUser($user)
	{
		$this->user = $user;
	}

	/**
	 * Set URI password.
	 *
	 * @param   string  $pass  The URI password.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function setPass($pass)
	{
		$this->pass = $pass;
	}

	/**
	 * Set URI host.
	 *
	 * @param   string  $host  The URI host.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function setHost($host)
	{
		$this->host = $host;
	}

	/**
	 * Set URI port.
	 *
	 * @param   integer  $port  The URI port number.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function setPort($port)
	{
		$this->port = $port;
	}

	/**
	 * Set the URI path string.
	 *
	 * @param   string  $path  The URI path string.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function setPath($path)
	{
		$this->path = $this->cleanPath($path);
	}

	/**
	 * Set the URI anchor string
	 * everything after the "#".
	 *
	 * @param   string  $anchor  The URI anchor string.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function setFragment($anchor)
	{
		$this->fragment = $anchor;
	}
	
	/**
	 * Returns the global JUri object, only creating it if it doesn't already exist.
	 *
	 * @param   string  $uri  The URI to parse.  [optional: if null uses script URI]
	 *
	 * @return  JUri  The URI object.
	 *
	 * @since   11.1
	 */
	public static function getInstance($uri = 'SERVER')
	{
		if (empty(static::$instances[$uri]))
		{
			// Are we obtaining the URI from the server?
			if ($uri == 'SERVER')
			{
				// Determine if the request was over SSL (HTTPS).
				if (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != 'off'))
				{
					$https = 's://';
				}
				else
				{
					$https = '://';
				}

				/*
				 * Since we are assigning the URI from the server variables, we first need
				 * to determine if we are running on apache or IIS.  If PHP_SELF and REQUEST_URI
				 * are present, we will assume we are running on apache.
				 */

				if (!empty($_SERVER['PHP_SELF']) && !empty($_SERVER['REQUEST_URI']))
				{
					// To build the entire URI we need to prepend the protocol, and the http host
					// to the URI string.
					$theURI = 'http' . $https . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
				}
				else
				{
					/*
					 * Since we do not have REQUEST_URI to work with, we will assume we are
					 * running on IIS and will therefore need to work some magic with the SCRIPT_NAME and
					 * QUERY_STRING environment variables.
					 *
					 * IIS uses the SCRIPT_NAME variable instead of a REQUEST_URI variable... thanks, MS
					 */
					$theURI = 'http' . $https . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];

					// If the query string exists append it to the URI string
					if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING']))
					{
						$theURI .= '?' . $_SERVER['QUERY_STRING'];
					}
				}

				// Extra cleanup to remove invalid chars in the URL to prevent injections through the Host header
				$theURI = str_replace(array("'", '"', '<', '>'), array("%27", "%22", "%3C", "%3E"), $theURI);
			}
			else
			{
				// We were given a URI
				$theURI = $uri;
			}

			static::$instances[$uri] = new static($theURI);
		}

		return static::$instances[$uri];
	}

	/**
	 * Returns the base URI for the request.
	 *
	 * @param   boolean  $pathonly  If false, prepend the scheme, host and port information. Default is false.
	 *
	 * @return  string  The base URI string
	 *
	 * @since   11.1
	 */
	public static function base($pathonly = false)
	{
		// Get the base request path.
		if (empty(static::$base))
		{
			$config = vFactory::getConfig();
			$uri = static::getInstance();
			$live_site = ($uri->isSsl()) ? str_replace("http://", "https://", $config->get('live_site')) : $config->get('live_site');

			if (trim($live_site) != '')
			{
				$uri = static::getInstance($live_site);
				static::$base['prefix'] = $uri->toString(array('scheme', 'host', 'port'));
				static::$base['path'] = rtrim($uri->toString(array('path')), '/\\');

				if (defined('VMPATH_BASE') && defined('VMPATH_ADMINISTRATOR'))
				{
					if (VMPATH_BASE == VMPATH_ADMINISTRATOR)
					{
						static::$base['path'] .= '/administrator';
					}
				}
			}
			else
			{
				static::$base['prefix'] = $uri->toString(array('scheme', 'host', 'port'));

				if (strpos(php_sapi_name(), 'cgi') !== false && !ini_get('cgi.fix_pathinfo') && !empty($_SERVER['REQUEST_URI'])) {
					// PHP-CGI on Apache with "cgi.fix_pathinfo = 0"

					// We shouldn't have user-supplied PATH_INFO in PHP_SELF in this case
					// because PHP will not work with PATH_INFO at all.
					$script_name = $_SERVER['PHP_SELF'];
				} else {
					// Others
					$script_name = $_SERVER['SCRIPT_NAME'];
				}

				static::$base['path'] = rtrim(dirname($script_name), '/\\');
			}
		}

		return $pathonly === false ? static::$base['prefix'] . static::$base['path'] . '/' : static::$base['path'];
	}

	/**
	 * Returns the root URI for the request.
	 *
	 * @param   boolean  $pathonly  If false, prepend the scheme, host and port information. Default is false.
	 * @param   string   $path      The path
	 *
	 * @return  string  The root URI string.
	 *
	 * @since   11.1
	 */
	public static function root($pathonly = false, $path = null)
	{
		// Get the scheme
		if (empty(static::$root)) {
			$uri = static::getInstance(static::base());

			static::$root['prefix'] = $uri->toString(array('scheme', 'host', 'port'));
			static::$root['path'] = rtrim($uri->toString(array('path')), '/\\');
		}

		// Set the scheme
		if (isset($path)) {
			static::$root['path'] = $path;
		}

		return $pathonly === false ? static::$root['prefix'] . static::$root['path'] . '/' : static::$root['path'];
	}

	/**
	 * Returns the URL for the request, minus the query.
	 *
	 * @return  string
	 *
	 * @since   11.1
	 */
	public static function current()
	{
		// Get the current URL.
		if (empty(static::$current))
		{
			$uri = static::getInstance();
			static::$current = $uri->toString(array('scheme', 'host', 'port', 'path'));
		}

		return static::$current;
	}

	/**
	 * Method to reset class static members for testing and other various issues.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 */
	public static function reset()
	{
		static::$instances = array();
		static::$base = array();
		static::$root = array();
		static::$current = '';
	}


	/**
	 * Checks if the supplied URL is internal
	 *
	 * @param   string  $url  The URL to check.
	 *
	 * @return  boolean  True if Internal.
	 *
	 * @since   11.1
	 */
	public static function isInternal($url)
	{
		$uri = static::getInstance($url);
		$base = $uri->toString(array('scheme', 'host', 'port', 'path'));
		$host = $uri->toString(array('scheme', 'host', 'port'));

		// @see JURITest
		if (empty($host) && strpos($uri->path, 'index.php') === 0
			|| !empty($host) && preg_match('#' . preg_quote(static::base(), '#') . '#', $base)
			|| !empty($host) && $host === static::getInstance(static::base())->host && strpos($uri->path, 'index.php') !== false
			|| !empty($host) && $base === $host && preg_match('#' . preg_quote($base, '#') . '#', static::base()))
		{
			return true;
		}

		return false;
	}

}

<?php

	/**
	 * Abstract implementation of a PHP socket-based server
	 *
	 * @version 1.0
	 */
	abstract class AbstractServer {
		// --------------- Fields ---------------

		/**
		 * The server version
		 *
		 * @var string
		 */
		public static $server_version;


		/**
		 * The protocoll version
		 *
		 * @var int
		 */
		public static $protocol_version;


		/**
		 * The port the server is listening on
		 *
		 * @var int
		 */
		public $port;


		/**
		 * The address the server is listening on
		 *
		 * @var string
		 */
		public $address;


		/**
		 * The server socket
		 *
		 * @var resource
		 */
		protected $socket;


		/**
		 * List of clients that are connected to the server
		 *
		 * @var array
		 */
		protected $clients;


		/**
		 * Stores the last error that occured
		 *
		 * @var string
		 */
		protected $lastError;


		/**
		 * True if the server is running
		 *
		 * @var bool
		 */
		protected $isRunning;


		// --------------- Methods ---------------

		/**
		 * Starts the server
		 *
		 */
		abstract public function __construct();


		/**
		 * Runs the main loop
		 *
		 */
		abstract public function listen();


		/**
		 * Stops the server
		 *
		 * @return bool
		 */
		abstract public function __destruct();


		/**
		 * Returns the list of clients
		 *
		 * @return array
		 */
		public function getClients() {
			return $this->clients;
		}


		/**
		 * Return the last occured error
		 *
		 * @return string
		 */
		public function getLastError() {
			return $this->lastError;
		}


		/**
		 * Sets the last error and dies when $die set to true
		 *
		 * @param string $error
		 * @param bool $die
		 */
		public function setLastError($error, $die = false) {
			$this->lastError = $error.PHP_EOL;

			if($die) die($this->log($this->lastError, "[ERROR]"));
		}


		/**
		 * Echoes message to console
		 *
		 * @param string $msg
		 * @param string $prefix
		 */
		public function log($msg, $prefix = "[INFO]") {
			echo date("m/d/y H:i:s", time()) . ": $prefix $msg". PHP_EOL;
		}
		

		/**
		 * Returns true if the server is running
		 *
		 * @return bool
		 */
		public function isRunning() {
			return $this->isRunning;
		}
	}


?>

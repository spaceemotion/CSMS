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
		 * @var int
		 */
		public static $version;


		/**
		 * The port the server is listening on
		 *
		 * @var int
		 */
		public static $port;


		/**
		 * The address the server is listening on
		 *
		 * @var string
		 */
		public static $address;


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
			$this->lastError = $error;

			if($die) die($this->lastError);
		}
	}


?>

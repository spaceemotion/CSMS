<?php

	require APATH.'server/AbstractServer.php';
	require APATH.'server/ClientHandler.php';

	/**
	 * Implementation of the MasterServer
	 *
	 * @version 1.0
	 */
	class MasterServer extends AbstractServer {
		public static $server_version = '1.0';
		public static $protocol_version = 0;

		public $address = '127.0.0.1';
		public $port = 3032;

		public function __construct() {
			// Create socket
			$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

			if (!is_resource($this->socket))
				$this->setLastError('Unable to create socket: '.socket_strerror(socket_last_error()), true );

			if (!socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, 1))
				$this->setLastError('Unable to set option on socket: '.socket_strerror(socket_last_error()), true);

			if (!socket_bind($this->socket, $this->address, $this->port))
				$this->setLastError('Unable to bind socket: '.socket_strerror(socket_last_error()), true);

			$reuse_val = socket_get_option($this->socket, SOL_SOCKET, SO_REUSEADDR);

			if ($reuse_val === false)
				$this->setLastError('Unable to get socket option: '.socket_strerror(socket_last_error()), true);
			else if ($reuse_val !== 0)
				$this->log('SO_REUSEADDR is set on socket !');

			// Start listening for connections
			socket_listen($this->socket);

			// Set to non block socket type
			socket_set_nonblock($this->socket);
			
			$this->isRunning = true;
		}

		public function __destruct() {
			// Close the master sockets
			socket_close($this->socket);
		}

		public function listen() {
			$read = array();
			
			if (count($this->clients)) {
				foreach ($this->clients as $v) {
					if($v->running){
						array_push($read, $v);
					}
				}
			}

			$this->clients = $read;

			if ($newsock = @socket_accept($this->socket)) {
				if (is_resource($newsock)) {
					echo "New client connected!\n";

					array_push($this->clients, new ClientHandler($newsock));
				}
			}

			if (count($this->clients)) {
				foreach ($this->clients as $v) {
					$v->handle();
				}
			}

			usleep(1000);
		}
	}

?>

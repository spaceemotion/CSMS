<?php

	/**
	 * @version 1.0
	 */
	class ClientHandler {

		public $running;

		private $server;
		private $socket;


		public function __construct($server, $socket){
			$this->server = $server;
			$this->socket = &$socket;
			$this->running = true;

			$this->write("> ", 2);
		}

		public function handle(){
			$string = rtrim($this->read(), "\r\n");

			if ($string != null && !empty($string)) {
				ob_start();
				var_dump($string);
				$out = ob_get_clean();

				$this->server->log($out, "IN <--");

				$this->write("> ");
			}
		}

		public function read(){
			return @socket_read($this->socket, 1024);
		}

		public function write($bytes, $size = null){
			if(!$size) $size = sizeof ($var);

			return socket_write($this->socket, $bytes, $size).chr(0);
		}

		public function close(){
			return socket_close($this->socket);
		}
	}

?>

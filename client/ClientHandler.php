<?php

	require APATH.'server/helper/StringHelper.php';

	/**
	 * @version 1.0
	 */
	class ClientHandler {

		public $running;
		public $id;

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
				$out = rtrim(ob_get_clean(), "\r\n");

				$this->server->log(rtrim(StringHelper::strtohex($out), ":") . ": $out", "IN <--");

				$className = ucfirst($string)."Command";
				$file = APATH."server/commands/$className.php";
				if(file_exists($file)) {
					include $file;

					$cmd = new $className();
					$cmd->execute(&$this);
				}

				$this->write("> ", 2);
			}
		}

		public function read(){
			return @socket_read($this->socket, 1024);
		}

		public function write($bytes, $size){
			return socket_write($this->socket, $bytes, $size).chr(0);
		}

		public function close(){
			return socket_close($this->socket);
		}
	}

?>

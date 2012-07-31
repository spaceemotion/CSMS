<?php

	/**
	* @version 1.0
	*/
	class ClientHandler {
		
		private $socket;
		public $running;
		
		public function __construct($sock){
			$this->socket = &$sock;
			$this->running = true;
			$this->write("> ", 2);
		}
		
		public function handle(){
			if ($string = $this->read()) {
				if($string != null) {
					var_dump(rtrim($string, '\r\n'));
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

<?php

	/*
	 * socket.php
	 * ------------------------------------------------
	 * File created by Verexa, changes by SpaceEmotion
	 * 
	 */

	ini_set('error_reporting', E_ALL ^ E_NOTICE);
	ini_set('display_errors', 1);

	// Set time limit to indefinite execution
	set_time_limit (0);

	// Set the ip and port we will listen on
	$address = '127.0.0.1';
	$port = 3000;

	$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

	if (!is_resource($sock))
		die('Unable to create socket: '. socket_strerror(socket_last_error()) . PHP_EOL);

	if (!socket_set_option($sock, SOL_SOCKET, SO_REUSEADDR, 1))
		die('Unable to set option on socket: '. socket_strerror(socket_last_error()) . PHP_EOL);

	if (!socket_bind($sock, $address, $port))
		die('Unable to bind socket: '. socket_strerror(socket_last_error()) . PHP_EOL);

	$rval = socket_get_option($sock, SOL_SOCKET, SO_REUSEADDR);

	if ($rval === false)
		die('Unable to get socket option: '. socket_strerror(socket_last_error()) . PHP_EOL);
	else if ($rval !== 0)
		echo 'SO_REUSEADDR is set on socket !' . PHP_EOL;

	// Start listening for connections
	socket_listen($sock);

	// Non block socket type
	socket_set_nonblock($sock);

	// Loop continuously

	$running = true;
	while ($running) {
		unset($read);

		$j = 0;

		if (count($client)) {
			foreach ($client AS $k => $v) {
				$read[$j] = $v;

				$j++;
			}
		}

		$client = $read;

		if ($newsock = @socket_accept($sock)) {
			if (is_resource($newsock)) {
				socket_write($newsock, "$j> ", 3).chr(0);

				echo "New client connected $j\n";

				$client[$j] = $newsock;
				$j++;
			}
		}

		if (count($client)) {
			foreach ($client AS $k => $v) {
				if ($string = @socket_read($v, 1024)) {
					if($string != null) {
						var_dump(rtrim($string, '\r\n'));

						switch($string){
							case "exit\r\n":
								unset($client[$k]);
								socket_close($v);
								break;
							case "shutdown\r\n":
								$running = false;
								break;
						}

						socket_write($v, "$k> ", 3).chr(0);
					}
				} else {

				}
			}
		}

		usleep(1000);
	}

	// Close the master sockets
	socket_close($sock);


?>

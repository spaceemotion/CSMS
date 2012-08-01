<?php

	// Defines
	define(APATH, __DIR__ . "/");
	date_default_timezone_set("UTC");

	// Requires
	require APATH.'server/MasterServer.php';

	// Initialise Server
	$server = new MasterServer();

	// Main loop
	while( $server->isRunning() ) {
		$server->listen();
		usleep(1000);
	}


	// Clean up
	unset($server);

?>

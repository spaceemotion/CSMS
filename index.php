<?php

	// Defines
	define(APATH, __DIR__ . "/");
	date_default_timezone_set("UTC");

	// Requires
	require APATH.'server/MasterServer.php';

	// Initialise Server
	$server = new MasterServer();

	// Main loop
	do {
		$server->listen();
		usleep(1000);
	} while( $server->isRunning() );


	// Clean up
	unset($server);

?>

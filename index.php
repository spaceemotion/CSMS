<?php

	// Defines
	define(APATH, __DIR__);

	// Requires
	require APATH.'server/MasterServer.php';

	// Initialise Server
	$server = new MasterServer();
	
	// Main loop
	while( $server->isRunning() )
		$server->listen();

	// Clean up
	unset($server);

?>

<?php

	require APATH.'server/commands/AbstractCommand.php';

	/**
	 * @version 1.0
	 */
	class ExitCommand extends AbstractCommand {
		public function execute(&$client) {
			$client->write("EXIT", 4);

			socket_close(&$client);
			unset($client);
		}
	}

?>

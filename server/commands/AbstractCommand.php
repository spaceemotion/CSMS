<?php

	/**
	 * Abstract Implementation of a server command
	 *
	 * @version 1.0
	 */
	abstract class AbstractCommand {
		/**
		 * Executes the command
		 *
		 */
		abstract public function execute(&$client);
	}

?>

<?php

class SessionController extends BaseController {

	/**
	 * postLogin
	 * @return void
	 */
	public function postLogin()
	{

		return Route::intended(action('home'));
	}


}
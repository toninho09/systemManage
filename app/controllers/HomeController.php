<?php

class HomeController extends BaseController {

	public function home(){
		return View::make('layout.principal');
	}

	public function login(){
		return View::make('home.login');
	}

}

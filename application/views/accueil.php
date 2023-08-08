<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil extends My_Controller {

	public function index()
	{
		$this->render_view('global/accueil');
	}

}
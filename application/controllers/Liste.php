<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Liste extends My_Controller
{
	 public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Europe/Moscow');
    $this->load->helper('url');
  }
  public function index()
  {
  }
  public function relance()
  {
  	$this->render_view('operatrice/liste_relance/relance');
  	
  }
}
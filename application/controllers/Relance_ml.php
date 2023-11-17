<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RelanceML extends My_Controller
{
    public function __construct()
    {
      parent::__construct();
    }

    public function index()
    {
    }

    public function display() {
        $this->render_view('relance_ML/relance_ML');
    }
}
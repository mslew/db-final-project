<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){
      $data = [
        'title' => 'Music Database',
        'description' => 'This is an keep track of your favorite artists, albums, and songs!'
      ];
     
      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About Me',
        'description' => 'This is my first experience using PHP and MySQL.'
      ];

      $this->view('pages/about', $data);
    }
  }
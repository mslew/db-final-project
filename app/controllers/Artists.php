<?php
  class Artists extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

       $this->artistModel = $this->model('Artist');
    }

    public function index(){
      // Get teams
      $teams = $this->teamModel->getArtist();

      $data = [
        'artists' => $artists
      ];

      $this->view('artists/index', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize post array
        $_post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'Name' => trim($_post['Name']),
          'DateFormed' => trim($_post['DateFormed']),
          'DateEnded' => trim($_post['DateEnded']),
          'Genre' => trim($_post['Genre']),
          'Name_err' => '',
          'DateFormed_err' => '',
          'DateEnded_err' => '',
          'Genre_err' => ''
        ];

        // Validate data
        if(empty($data['Name'])){
          $data['Name_err'] = 'Please enter a artist name';
        }
        if(empty($data['DateFormed'])){
          $data['DateFormed_err'] = 'Please enter the date formed';
        }
        if(empty($data['DateEnded'])){
            $data['DateEnded_err'] = 'Please enter the date ended';
          }
        if(empty($data['Genre'])){
            $data['Genre_err'] = 'Please enter a genre';
        }

        // Make sure no errors
        if(empty($data['Name_err']) && empty($data['DateFormed_err'] && $data['DateEnded_err']) && empty($data['Genre_err'])){
          // Validated
          if($this->artistModel->addArtist($data)){
            redirect('artists');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('artists/add', $data);
        }

      } else {
        $data = [
          'Name' => '',
          'DateFormed' => '',
          'DateEnded' => '',
          'Genre' => ''
        ];
  
        $this->view('artists/add', $data);
      }
    }

    public function edit($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize post array
        $_post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $id,
          'Name' => trim($_post['Name']),
          'DateFormed' => trim($_post['DateFormed']),
          'DateEnded' => trim($_post['DateEnded']),
          'Genre' => trim($_post['Genre']),
          'Name_err' => '',
          'DateFormed' => '',
          'DateEnded' => '',
          'Genre' => '',
        ];

        // Validate data
        if(empty($data['Name'])){
            $data['Name_err'] = 'Please enter a artist name';
          }
          if(empty($data['DateFormed'])){
            $data['DateFormed_err'] = 'Please enter the date formed';
          }
          if(empty($data['DateEnded'])){
              $data['DateEnded_err'] = 'Please enter the date ended';
            }
          if(empty($data['Genre'])){
              $data['Genre_err'] = 'Please enter a genre';
          }

        // Make sure no errors
        if(empty($data['Name_err']) && empty($data['DateFormed_err'] && $data['DateEnded_err']) && empty($data['Genre_err'])){
          // Validated
          if($this->artistModel->updateArtist($data)){
            redirect('artists');          
          } else {
            die('Something went wrong');
          }
          
        } else {
          // Load view with errors
          $this->view('artists/edit', $data);
        }

      } else {
        // Get existing team from model
        $team = $this->artistModel->getAristById($id);


        $data = [
          'id' => $id,
          'Name' => $team->artistName,
          'DateFormed' => $team->artistDateFormed,
          'DateEnded' => $team->artistDateEnded,
          'Genre' => $team->Genre
        ];
  
        $this->view('artists/edit', $data);
      }
    }

    public function show($id){
      $team = $this->artistModel->getArtistById($id);

      $data = [
        'Artist' => $Artist,
      ];

      $this->view('artists/show', $data);
    }

    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->artistModel->deleteTeam($id)){
          //flash('post_message', 'Team Removed');
          redirect('teams');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('teams');
      }
    }
  }
<?php
  class Artist {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getArtists(){
      $this->db->query('SELECT * 
                        FROM Artist
                        ORDER BY Name;
                        ');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addArtist($data){
      $this->db->query('INSERT INTO Artist (Name, DateFormed, DateEnded Genre) VALUES(:Name, :DateFormed, :DateEnded :Genre)');
      // Bind values
      $this->db->bind(':name', $data['Name']);
      $this->db->bind(':DateFormed', $data['DateFormed']);
      $this->db->bind(':DateEnded', $data['DateEnded']);
      $this->db->bind(':Genre', $data['Genre']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateArtist($data){
      $this->db->query('UPDATE Artist SET Name = :Name, DateFormed = :DateFormed, DateEnded = :DateEnded, Genre = :Genre WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':name', $data['Name']);
      $this->db->bind(':DateFormed', $data['DateFormed']);
      $this->db->bind(':DateEnded', $data['DateEnded']);
      $this->db->bind(':Genre', $data['Genre']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
      return true;
    }

    public function getArtistById($id){
      $this->db->query('SELECT ArtistID, Name, DateFormed, DateEnded, Genre, FROM Artist');

      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function deleteArtist($id){
      $this->db->query('DELETE FROM Artist WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }
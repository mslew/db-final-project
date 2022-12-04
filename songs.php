<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Music Database</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Fifth navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Music Database</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
        aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar">
        <div class="navbar-nav me-auto mb-2 mb-lg-0">
          <a class="nav-link" aria-current="page" href="index.html">Home</a>
          <a class="nav-link" href="about.html">About</a>
          <a class="nav-link" aria-current="players" href="artists.php">Artists</a>
          <a class="nav-link" aria-current="players" href="albums.php">Albums</a>
          <a class="nav-link" aria-current="players" href="songs.php">Songs</a>
        </div>
      </div>
    </div>
  </nav>
    <div class="container-fluid">
        <h1 class="display-3">Songs</h1>
        <div class="row">
          <div class="col">
          <p>Add New Song</p>
            <form class="mb-2" method="post" action="songs.php">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Album Name" name="albumName">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="Song Name" name="songName">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="Length (MM:SS:MS)" name="length">
                </div>
              <button id="addSong"class="mt-2 mb-5" name="add">Add Song</button>
            </form>
          </div>
          <div class="col">
          <p>Delete Song by Name</p>
              <form class="mb-2" method="post" action="songs.php">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Song Name" name="songName">
                </div>
              <button id="deleteSong"class="mt-2 mb-5" name="delete">Delete Song</button>
            </form>
          </div>
          <div class="col">
          <p>Update Song</p>
            <form class="mb-2" method="post" action="songs.php">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Song Name" name="songName">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="Length (MM:SS:MS)" name="length">
                </div>
              <button id="updateSong"class="mt-2 mb-5" name="update">Update Song</button>
            </form>
          </div>
        </div>
        <div class="container">
        <?php
          function grabPdo(){
            $user = "php_user";
            $pass = "secure_password";
            $dsn = "mysql:host=127.0.0.1;dbname=music";
            try{
              $pdo = new PDO($dsn, $user, $pass);
              return $pdo;
            }catch(PDOException $e){
              echo $e->getMessage();
              die;
            }
          }

          if(isset($_POST['add'])){
            $albumName = trim($_POST['albumName']);
            $songName = trim($_POST['songName']);
            $length = trim($_POST['length']);
            addSong($albumName, $songName, $length);
          }
          if(isset($_POST['delete'])){
            $songName = trim($_POST['songName']);
            deleteSong($songName);
          }
          if(isset($_POST['update'])){
            $songName = trim($_POST['songName']);
            $length = trim($_POST['length']);
            updateSong($songName, $length);
          }    

          function addSong($albumName, $songName, $length){
            $pdo = grabPdo();
            $query = "INSERT INTO SONG (AlbumID, Name, Length) " .
                      "VALUES((SELECT AlbumID FROM ALBUM WHERE Name = :albumName), :name, :length)" ;

            $statement = $pdo->prepare($query);
            $statement->bindValue('albumName', $albumName);
            $statement->bindValue('name', $songName);
            $statement->bindValue('length', $length);
            $statement->execute();
          }

          function deleteSong($songName){
            $pdo = grabPdo();
            $query = "DELETE FROM Song WHERE Name = :name";

            $statement = $pdo->prepare($query);
            $statement->bindValue('name', $songName);
            $statement->execute();
          }

          function updateSong($songName, $length){
            $pdo = grabPdo();

            $updateQuery = "UPDATE Song SET Name = :name, Length = :length WHERE Name = :name";

            $statement = $pdo->prepare($updateQuery);
            $statement->bindValue('name', $songName);
            $statement->bindValue('length', $length);
            $statement->execute();
          }

          function displayAll(){
            $pdo = grabPdo();
            $query = "SELECT * FROM Song";
            $statement = $pdo->query($query);
            //echo "Rows selected = ".$statement->rowCount();
            echo "<ul class='list-group'>";

            while($row = $statement->fetch()){
                echo "<li class='list-group-item'>".$row['Name']." ".$row['Length']." </li>";
            }
            echo "</ul>";
          }
          displayAll();
        ?>
        </div>
    </div>
</body>
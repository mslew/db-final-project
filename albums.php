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
        <h1 class="display-3">Albums</h1>
        <div class="row">
          <div class="col">
          <p>Add New Album</p>
            <form class="mb-2" method="post" action="albums.php">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Artist Name" name="artistName">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="Album Name" name="albumName">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="Release Date (YYYY-MM-DD)" name="releaseDate">
                </div>
              <button id="addAlbum"class="mt-2 mb-5" name="add">Add Album</button>
            </form>
          </div>
          <div class="col">
          <p>Delete Album by Name</p>
              <form class="mb-2" method="post" action="albums.php">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Album Name" name="albumName">
                </div>
              <button id="deleteAlbum"class="mt-2 mb-5" name="delete">Delete Album</button>
            </form>
          </div>
          <div class="col">
          <p>Update Album</p>
            <form class="mb-2" method="post" action="albums.php">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Album Name" name="albumName">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="Release Date (YYYY-MM-DD)" name="releaseDate">
                </div>
              <button id="updateAlbum"class="mt-2 mb-5" name="update">Update Album</button>
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
            $artistName = trim($_POST['artistName']);
            $albumName = trim($_POST['albumName']);
            $releaseDate = trim($_POST['releaseDate']);
            addAlbum($artistName, $albumName, $releaseDate);
          }
          if(isset($_POST['delete'])){
            $albumName = trim($_POST['albumName']);
            deleteAlbum($albumName);
          }
          if(isset($_POST['update'])){
            $albumName = trim($_POST['albumName']);
            $releaseDate = trim($_POST['releaseDate']);
            updateAlbum($albumName, $releaseDate);
          }    

          function addAlbum($artistName, $albumName, $releaseDate){
            $pdo = grabPdo();
            $query = "INSERT INTO Album (Name, ReleaseDate) " .
                      "VALUES(?, ?)" ;

            $statement = $pdo->prepare($query);
            $statement->bindValue(1, $albumName);
            $statement->bindValue(2, $releaseDate);
            $statement->execute();

            $query = "INSERT INTO ArtistAlbum (ArtistID, AlbumID) " .
                      "VALUES((SELECT ArtistID FROM Artist WHERE Name = :artistName), (SELECT AlbumID FROM Album WHERE Name = :albumName))" ;

            $statement = $pdo->prepare($query);
            $statement->bindValue('artistName', $artistName);
            $statement->bindValue('albumName', $albumName);
            $statement->execute();
          }

          function deleteAlbum($albumName){
            $pdo = grabPdo();
            $query = "DELETE FROM Album WHERE Name = :name";

            $statement = $pdo->prepare($query);
            $statement->bindValue('name', $albumName);
            $statement->execute();
          }

          function updateAlbum($albumName, $releaseDate){
            $pdo = grabPdo();

            $updateQuery = "UPDATE Album SET Name = :name, ReleaseDate = :releaseDate WHERE Name = :name";

            $statement = $pdo->prepare($updateQuery);
            $statement->bindValue('name', $albumName);
            $statement->bindValue('releaseDate', $releaseDate);
            $statement->execute();
          }

          function displayAll(){
            $pdo = grabPdo();
            $query = "SELECT * FROM Album";
            $statement = $pdo->query($query);
            //echo "Rows selected = ".$statement->rowCount();
            echo "<ul class='list-group'>";

            while($row = $statement->fetch()){
                echo "<li class='list-group-item'>".$row['Name']." ".$row['ReleaseDate']." </li>";
            }
            echo "</ul>";
          }
          displayAll();
        ?>
        </div>
    </div>
</body>
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
        <h1 class="display-3">Artists</h1>
        <div class="row">
          <div class="col">
          <p>Add New Artist</p>
            <form class="mb-2" method="post" action="artists.php">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Artist Name" name="artistName">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="Date Formed (YYYY-MM-DD)" name="dateFormed">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="Date ended (YYYY-MM-DD)" name="dateEnded">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="Genre" name="genre">
                </div>
              <button id="addArtist"class="mt-2 mb-5" name="add">Add Artist</button>
            </form>
          </div>
          <div class="col">
          <p>Delete Artist by Name</p>
              <form class="mb-2" method="post" action="artists.php">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Artist Name" name="artistName">
                </div>
              <button id="deleteArtist"class="mt-2 mb-5" name="delete">Delete Artist</button>
            </form>
          </div>
          <div class="col">
          <p>Update Artist</p>
            <form class="mb-2" method="post" action="artists.php">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Artist Name" name="artistName">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="Date Formed (YYYY-MM-DD)" name="dateFormed">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="Date ended (YYYY-MM-DD)" name="dateEnded">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="Genre" name="genre">
                </div>
              <button id="updateArtist"class="mt-2 mb-5" name="update">Update Artist</button>
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
            $dateFormed = trim($_POST['dateFormed']);
            $dateEnded = trim($_POST['dateEnded']);
            $genre = trim($_POST['genre']);
            addArtist($artistName, $dateFormed, $dateEnded, $genre);
          }
          if(isset($_POST['delete'])){
            $artistName = trim($_POST['artistName']);
            deleteArtist($artistName);
          }
          if(isset($_POST['update'])){
            $artistName = trim($_POST['artistName']);
            $dateFormed = trim($_POST['dateFormed']);
            $dateEnded = trim($_POST['dateEnded']);
            $genre = trim($_POST['genre']);
            updateArtist($artistName, $dateFormed, $dateEnded, $genre);
          }    

          function addArtist($artistName, $dateFormed, $dateEnded, $genre){
            $pdo = grabPdo();
            $query = "INSERT INTO Artist (Name, DateFormed, DateEnded, Genre) " .
                      "VALUES(?, ?, ?, ?)" ;

            $statement = $pdo->prepare($query);
            $statement->bindValue(1, $artistName);
            $statement->bindValue(2, $dateFormed);
            $statement->bindValue(3, $dateEnded);
            $statement->bindValue(4, $genre);
            $statement->execute();
          }

          function deleteArtist($artistName){
            $pdo = grabPdo();
            $query = "DELETE FROM Artist WHERE Name = :name";

            $statement = $pdo->prepare($query);
            $statement->bindValue('name', $artistName);
            $statement->execute();
          }

          function updateArtist($artistName, $dateFormed, $dateEnded, $genre){
            $pdo = grabPdo();
            /**$query = "SELECT ArtistID FROM Artist WHERE Name = :name";
            
            $statement = $pdo->prepare($query);
            $statement->bindValue('name', $artistName);
            $id = $statement->execute();

            echo $statement->execute();*/

            $updateQuery = "UPDATE Artist SET Name = :name, DateFormed = :dateformed, DateEnded = :dateended, Genre = :genre WHERE Name = :name";

            $statement = $pdo->prepare($updateQuery);
            $statement->bindValue('name', $artistName);
            $statement->bindValue('dateformed', $dateFormed);
            $statement->bindValue('dateended', $dateEnded);
            $statement->bindValue('genre', $genre);
            //$statement->bindValue('id', $id);
            $statement->execute();
          }

          function displayAll(){
            $pdo = grabPdo();
            $query = "SELECT * FROM Artist";
            $statement = $pdo->query($query);
            //echo "Rows selected = ".$statement->rowCount();
            echo "<ul class='list-group'>";

            while($row = $statement->fetch()){
                echo "<li class='list-group-item'>".$row['Name']." ".$row['DateFormed']." ".$row['DateEnded']." ".$row['Genre']."</li>";
            }
            echo "</ul>";
          }
          displayAll();
        ?>
        </div>
    </div>
</body>
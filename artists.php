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
                  <input type="text" class="form-control" placeholder="Date ended (YYYY-MM-DD) this can be left empty" name="dateEnded">
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
                  <input type="text" class="form-control" placeholder="Date ended (YYYY-MM-DD) this can be left empty" name="dateEnded">
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
            if((!isset($artistName) || $artistName == '') || (!isset($dateFormed) || $dateFormed == '') || (!isset($genre) || $genre == '')){
              $message = "You need a value for each field! Please follow the format!";
              echo $message;
            }else{
              if(!isset($dateEnded) || $dateEnded == ''){
                $dateEnded = NULL;
              }
              addArtist($artistName, $dateFormed, $dateEnded, $genre);
            }
          }
          if(isset($_POST['delete'])){
            $artistName = trim($_POST['artistName']);
            if(!isset($artistName) || $artistName == ''){
              $message = "You need a value for each field! Please follow the format!";
              echo $message;
            }else{
              deleteArtist($artistName);
            }
          }
          if(isset($_POST['update'])){
            $artistName = trim($_POST['artistName']);
            $dateFormed = trim($_POST['dateFormed']);
            $dateEnded = trim($_POST['dateEnded']);
            $genre = trim($_POST['genre']);
            if((!isset($artistName) || $artistName == '') || (!isset($dateFormed) || $dateFormed == '') || (!isset($genre) || $genre == '')){
              $message = "You need a value for each field! Please follow the format!";
              echo $message;
            }else{
              if(!isset($dateEnded) || $dateEnded == ''){
                $dateEnded = NULL;
              }
              updateArtist($artistName, $dateFormed, $dateEnded, $genre);
            }
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

            $updateQuery = "UPDATE Artist SET Name = :name, DateFormed = :dateformed, DateEnded = :dateended, Genre = :genre WHERE Name = :name";

            $statement = $pdo->prepare($updateQuery);
            $statement->bindValue('name', $artistName);
            $statement->bindValue('dateformed', $dateFormed);
            $statement->bindValue('dateended', $dateEnded);
            $statement->bindValue('genre', $genre);
            $statement->execute();
          }

          function displayAll(){
            $pdo = grabPdo();
            $query = "SELECT a.Name ArtistName, a.DateFormed DateFormed, a.DateEnded DateEnded, a.Genre Genre FROM Artist a";
            $statement = $pdo->query($query);
            //echo "Rows selected = ".$statement->rowCount();
            echo "<div class='row'>";

            while($row = $statement->fetch()){
              echo "<div class='card' style='width: 18rem;'>
              <div class='card-body'>
                  <h5 class='card-title'>".$row['ArtistName']."</h5>
                  <h6 class='card-subtitle mb-2 text-muted'>".$row['Genre']."</h6>";
              if($row['DateEnded'] == NULL){
                echo "<h6 class='card-subtitle mb-2 text-muted'>Formed: ".$row['DateFormed']."</h6>
                <h6 class='card-subtitle mb-2 text-muted'>Still Active</h6>
                </div>
                </div>";
              }else{
                echo "<h6 class='card-subtitle mb-2 text-muted'>".$row['DateFormed']." - ".$row['DateEnded']."</h6>
                </div>
                </div>";
              }
            }
            echo "</div>";
          }
          displayAll();
        ?>
        </div>
    </div>
</body>
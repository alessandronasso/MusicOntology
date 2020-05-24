<?php
/**
 * In questo file gestisco la pagina relativa ai generi musicali.
 */

/** 
 * La variabile $id verra' utilizzata per effettuare le query.
 */

$id   = $_GET['id'];
$name = 0;

/** 
 * Qui effetto l'import del file contenente le query e le librerie per interrogare
 * GraphDb.
 */

require_once("sparqllib.php");
require('query.php');

/** 
 * Questa sezione e' dedicata all'estrazione dei dati relativi ai generi musicali e alle tracce che appartengono ad essi.
 */

$tracce  = sparql_get("http://localhost:7200/repositories/TMO", $query_tracce_per_genere);
$album   = sparql_get("http://localhost:7200/repositories/TMO", $query_album_per_genere);
$artisti = sparql_get("http://localhost:7200/repositories/TMO", $query_artisti_per_genereSolo);
$gruppi  = sparql_get("http://localhost:7200/repositories/TMO", $query_artisti_per_genereGruppi);

?>
    <html>
    <header>
        <title>The Music Ontology</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/37779f79c0.js"></script>
    </header>

    <body style="background-color: #F0F0F0">
            <div class="container h-100">
                <div class="row h-100 justify-content-center align-items-center">
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Tracce <?php
echo $id;
?></h3>
                            </div>
                            <ul class="list-group">
                                <?php
foreach ($tracce as $traccia) {
    echo '<a href="http://localhost/musicontology/traccia.php?id=' . str_replace("#", "à", $traccia['traccia']) . '" class="list-group-item">' . $traccia['titoloTraccia'] . '</a>';
}
?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                     <h3 class="panel-title">Album <?php
echo $id;
?></h3>
                            </div>
                            <ul class="list-group">
                                <?php
foreach ($album as $solo) {
    echo '<a href="http://localhost/musicontology/album.php?id=' . str_replace("#", "à", $solo['album']) . '" class="list-group-item">' . $solo['titoloAlbum'] . '</a>';
}
?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                     <h3 class="panel-title">Artisti <?php
echo $id;
?></h3>
                            </div>
                            <ul class="list-group">
                                <?php
foreach ($artisti as $gruppo) {
    print '<a href="http://localhost/musicontology/artista.php?id=' . str_replace("#", "à", $gruppo['artista']) . '" class="list-group-item">' . $gruppo['nomeArtista'];
    print '<br>';
}
foreach ($gruppi as $gruppo) {
    print '<a href="http://localhost/musicontology/gruppo.php?id=' . str_replace("#", "à", $gruppo['artista']) . '" class="list-group-item">' . $gruppo['nomeArtista'];
    print '<br>';
}
print "</a>";
?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </body>

    </html>
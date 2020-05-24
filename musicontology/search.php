<?php 
   /**
   * In questo file gestisco la pagina relativa alla ricerca degli individui nella nostra ontologia.
   */
   ?>
    <html>
    <header>
        <title>The Music Ontology</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        <style>
            .form-control-borderless {
                border: none;
            }
            
            .form-control-borderless:hover,
            .form-control-borderless:active,
            .form-control-borderless:focus {
                border: none;
                outline: none;
                box-shadow: none;
            }
        </style>
    </header>

    <body style="background-color: #F0F0F0">
        <div class="container h-100">
            <br>
            <br>
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-10 col-lg-8 vcenter">
                    <form class="card card-sm" action="search.php" method="post">
                        <div class="card-body row no-gutters align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-search h4 text-body"></i>
                            </div>
                            <div class="col">
                                <input name="name" required class="form-control form-control-lg form-control-borderless" type="search" placeholder="Cerca...">
                            </div>
                            <div class="col-auto">
                                <input class="btn btn-lg btn-success" type="submit"></input>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="justify-content-center align-items-center">
                <div class="card-columns">
                    <?php set_error_handler(function(){});
                  if (isset($_POST['name'])) { $name = $_POST['name']; }
                  $prefisso = "http://www.semanticweb.org/bruno/ontologies/2020/1/music_ontology#";
                  require_once( "sparqllib.php" );
                  $id = 0;
                  require("query.php");

                  $data_solo = sparql_get("http://localhost:7200/repositories/TMO", $query_solo_search);
                  $data_gruppo = sparql_get("http://localhost:7200/repositories/TMO", $query_gruppo_search);
                  $data_album = sparql_get("http://localhost:7200/repositories/TMO", $query_album_search);
                  $data_tracce = sparql_get("http://localhost:7200/repositories/TMO", $query_tracce_search);
                  $data_disco = sparql_get("http://localhost:7200/repositories/TMO", $query_disco_search);

                  foreach ($data_solo as $row) {
                    print '
                      <div class="card" style="max-width: 230px;">
                        <img class="card-img-top img-fluid" src="'.$row['immagine'].'" alt="img">
                        <div class="card-body">
                          <h5 class="card-title">'.(str_replace("_", " ", (str_replace($prefisso, "", $row['artista'])))).'
                          </h5>
                          <p class="card-text">'.$row['commento'].'
                          </p>
                        </div>
                        <div class="card-footer text-center bg-white">
                          <a class="btn btn-outline-secondary" href="artista.php/?id='.str_replace("#", "à", $row['artista']).'">Visualizza
                          </a>
                        </div>
                      </div>';
                  }

                  foreach ($data_gruppo as $row) {
                    print '
                      <div class="card" style="max-width: 230px;">
                        <img class="card-img-top img-fluid" src="'.$row['immagine'].'" alt="img">
                        <div class="card-body">
                          <h5 class="card-title">'.$row['nomeGruppo'].'
                          </h5>
                          <p class="card-text">'.$row['commento'].'
                          </p>
                        </div>
                        <div class="card-footer text-center bg-white">
                          <a class="btn btn-outline-secondary" href="gruppo.php/?id='.str_replace("#", "à", $row['artista']).'">Visualizza
                          </a>
                        </div>
                      </div>';
                  }

                  foreach ($data_album as $row) {
                    if (!isset($row['immagine'])) $row['immagine']="http://localhost/musicontology/noalbum.png";
                    print '
                      <div class="card" style="max-width: 230px;">
                        <img class="card-img-top img-fluid" src="'.$row['immagine'].'" alt="img">
                        <div class="card-body">
                          <h5 class="card-title">'.$row['nomeAlbum'].'
                          </h5>
                          <p class="card-text">'.$row['commento'].'
                          </p>
                        </div>
                        <div class="card-footer text-center bg-white">
                          <a class="btn btn-outline-secondary" href="album.php/?id='.str_replace("#", "à", $row['album']).'">Visualizza
                          </a>
                        </div>
                      </div>';
                  }

                  foreach ($data_tracce as $row) {
                    print '
                      <div class="card" style="max-width: 230px;">
                      <img class="card-img-top img-fluid" src="http://localhost/musicontology/track.png" alt="img">
                        <div class="card-body">
                          <h5 class="card-title">'.$row['nomeTraccia'].'
                          </h5>
                          <p class="card-text">'.$row['commento'].'
                          </p>
                        </div>
                        <div class="card-footer text-center bg-white">
                          <a class="btn btn-outline-secondary" href="traccia.php/?id='.str_replace("#", "à", $row['traccia']).'">Visualizza
                          </a>
                        </div>
                      </div>';
                  }

                  foreach ($data_disco as $row) {
                    if (!isset($row['immagine'])) $row['immagine']="http://localhost/musicontology/nologo.png";
                    print '
                      <div class="card" style="max-width: 230px;">
                      <img class="card-img-top img-fluid" src="'.$row['immagine'].'" alt="img">
                        <div class="card-body">
                          <h5 class="card-title">'.$row['nomeDisco'].'
                          </h5>
                          <p class="card-text">'.$row['commento'].'
                          </p>
                        </div>
                        <div class="card-footer text-center bg-white">
                          <a class="btn btn-outline-secondary" href="casaDiscografica.php/?id='.str_replace("#", "à", $row['disco']).'">Visualizza
                          </a>
                        </div>
                      </div>';
                  }
                  ?>
                </div>
            </div>
        </div>
    </body>

    </html>
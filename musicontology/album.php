<?php 
   /**
   * In questo file gestisco la pagina relativa agli album.
   */
   
   /** 
   * La variabile $id verra' utilizzata per effettuare le query.
   */
   
    $id = $_GET['id'];
    $id = str_replace("à", "#", $id);
    $name = 0;
   
    /** 
   * Qui effetto l'import del file contenente le query e le librerie per interrogare
   * GraphDb.
   */
   
    require_once( "sparqllib.php" );
    require('query.php');
   
   
    /** 
   * Questa sezione e' dedicata all'estrazione dei dati relativi agli album e ai relativi autori.
   */
    
    $data_wd = sparql_get("http://localhost:7200/repositories/TMO", $query_album_wikidata)[0];
    $data_album = sparql_get("http://localhost:7200/repositories/TMO", $query_album_release_performer_nome);
    $data_tracceAlbum = sparql_get("http://localhost:7200/repositories/TMO", $query_tracce_album);
    $data_performer = sparql_get("http://localhost:7200/repositories/TMO", $query_performer_album);
    $data_genere = sparql_get("http://localhost:7200/repositories/TMO", $query_genere_album);
    if (!isset($data_wd['immagine'])) $data_wd['immagine'] = "http://localhost/musicontology/noalbum.png";
    $performer_solo = sparql_get("http://localhost:7200/repositories/TMO", $query_SoloPerformer_album);
    $performer_gruppo = sparql_get("http://localhost:7200/repositories/TMO", $query_GruppoPerformer_album);

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
            <div class="card text-center">
               <div class="card-header">
                  <h4><?php echo $data_album[0]['titoloAlbum']; ?></h4>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="<?php echo $data_wd['immagine']; ?>" class="img-circle img-fluid"> </div>
                     <div class=" col-md-9 col-lg-9 ">
                        <table class="table table-user-information">
                           <tbody>
                              <td>Data di pubblicazione:</td>
                              <td><?php echo date('d/m/Y', strtotime($data_wd['dataPub'])); ?></td>
                              </tr>
                              <tr>
                              <tr>
                                 <td>Release:</td>
                                 <td><?php
                                    foreach ($data_album as $solo) {
                                      print '<a href="http://localhost/musicontology/release.php?id='.str_replace("#", "à", $solo['release']).'">'.str_replace("_", " ", str_replace("http://www.semanticweb.org/bruno/ontologies/2020/1/music_ontology#", "", $solo['release'])).'</a>';
                                      print '<br>';
                                    }
                                    ?></td>
                              </tr>
                              <tr>
                                 <td>Genere:</td>
                                 <td><?php 
                                    foreach ($data_genere as $solo) {
                                      print '<a href="http://localhost/musicontology/genere.php?id='.$solo['genere'].'">'.$solo['genere'].'</a>';
                                      print '<br>';
                                    }
                                    ?></td>
                              </tr>
                              <tr>
                                 <td>Performer:</td>
                                 <td><?php    
                                    foreach ($performer_solo as $solo_row) {
                                   print '<a href="http://localhost/musicontology/artista.php?id='.str_replace("#", "à", $solo_row['artista']).'">'.$solo_row['nomeArtista'].'</a>';
                                   print '<br>';
                                 
                                 }
                                 foreach ($performer_gruppo as $gruppo) {
                                   print '<a href="http://localhost/musicontology/gruppo.php?id='.str_replace("#", "à", $gruppo['artista']).'">'.$gruppo['nomeArtista'].'</a>';
                                   print '<br>';
                                 }
                                    ?></td>
                              </tr>
                              <tr>
                                 <td>Numero tracce:</td>
                                 <td><?php echo $data_album[0]['numero']; ?></td>
                              </tr>
                              <td>Tracce contenute:</td>
                              <td><?php 
                                 foreach ($data_tracceAlbum as $solo) {
                                   print '<a href="http://localhost/musicontology/traccia.php?id='.str_replace("#", "à", $solo['traccia']).'">'.$solo['nomeTraccia'].'</a>';
                                   print '<br>';
                                 }
                                 ?>
                              </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="card-footer text-muted">
                  <span class="pull-left">
                  <a href="<?php echo $data_wd['Agent']; ?>" class="btn btn-primary"><i class="fa-info-circle"></i> WikiData</a>
                  </span>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>
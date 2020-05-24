<?php 
   /**
   * In questo file gestisco la pagina relativa alle case discografiche.
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
   * Questa sezione e' dedicata all'estrazione dei dati relativi alle case discografiche e agli artisti da loro messi sotto contratto.
   */
   
   $data_wd = sparql_get("http://localhost:7200/repositories/TMO", $query_disco_wikidata);
   $data_release = sparql_get("http://localhost:7200/repositories/TMO", $query_disco_release);
   $data_performerSolo = sparql_get("http://localhost:7200/repositories/TMO", $query_disco_performerSolo);
   $data_performerGruppo = sparql_get("http://localhost:7200/repositories/TMO", $query_disco_performerGruppo);
   $data_nome_disco = sparql_get("http://localhost:7200/repositories/TMO", $query_disco_nome);

   if (!isset($data_wd['immagine'])) $data_wd['immagine']="http://localhost/musicontology/nologo.png";
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
                  <h4><?php echo $data_nome_disco[0]['nomeDisco']; ?></h4>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="<?php echo $data_wd['immagine']; ?>" class="img-circle img-fluid"> </div>
                     <div class=" col-md-9 col-lg-9 ">
                        <table class="table table-user-information">
                           <tbody>
                              <td>Anno di fondazione</td>
                              <td><?php echo date('Y', strtotime($data_wd['fondazione'])); ?></td>
                              </tr>
                              <tr>
                                 <td>Paese di fondazione</td>
                                 <td><?php echo getWikiDataLabel($data_wd[0]['paese']); ?></td>
                              </tr>
                              <tr>
                              <tr>
                                 <td>Elenco release:</td>
                                 <td><?php
                                    foreach ($data_release as $solo) {
                                      print '<a href="http://localhost/musicontology/release.php?id='.(str_replace("#", "à", $solo['release']).'">'.str_replace("()", "", str_replace("Release", "", (str_replace("_", " ", str_replace("http://www.semanticweb.org/bruno/ontologies/2020/1/music_ontology#", "", $solo['release'])))))).'</a>';
                                      print '<br>';
                                    }
                                    ?></td>
                              </tr>
                              <tr>
                                 <td>Correlati:</td>
                                 <td><?php 
                                    foreach ($data_performerSolo as $solo) {
                                      print '<a href="http://localhost/musicontology/artista.php?id='.(str_replace("#", "à", $solo['artista'])).'">'.$solo['nomeArtista'].'</a>';
                                      print '<br>';
                                    }
                                    foreach ($data_performerGruppo as $solo) {
                                      print '<a href="http://localhost/musicontology/gruppo.php?id='.(str_replace("#", "à", $solo['artista'])).'">'.$solo['nomeArtista'].'</a>';
                                      print '<br>';
                                    }
                                    ?></td>
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
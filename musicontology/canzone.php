<?php
   /**
   * In questo file gestisco la pagina relativa alle canzoni.
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
    ini_set('memory_limit', '-1');
   
   
    /** 
   * Questa sezione e' dedicata all'estrazione dei dati relativi alle canzoni e agli artisti che ne hanno composto tracce e cover.
   */
   
   $dati_canzone = sparql_get("http://localhost:7200/repositories/TMO", $query_nomeCanzone);
   $dati_tracciaArtista = sparql_get("http://localhost:7200/repositories/TMO", $query_data_canzoneTraccia);
   $dati_tracciaPerformataDa = sparql_get("http://localhost:7200/repositories/TMO", $query_data_performataDa);
   
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
               <div class="col-md-4 text-center">
                  <div class="panel panel-primary">
                     <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $dati_canzone[0]['nomeCanzone']?></h3>
                     </div>
                     <ul class="list-group">
                        <div class="list-group-item">
                           <?php foreach ($dati_tracciaArtista as $solo) {
                              echo '<a href="http://localhost/musicontology/artista.php?id='.str_replace("#", "à", $solo['artista']).'">'.$solo['nomeArtista'].'</a>';
                              echo "   -   ";
                              echo '<a href="http://localhost/musicontology/traccia.php?id='.str_replace("#", "à", $solo['traccia']).'">'.$solo['nomeTraccia'].'</a>';
                              } ?>
                        </div>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>
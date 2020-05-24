<?php 
   /**
   * In questo file gestisco la pagina relativa alle release.
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
   * Questa sezione e' dedicata all'estrazione dei dati relativi alle release e alla casa discografica associata.
   */
   
   $data_release = sparql_get("http://localhost:7200/repositories/TMO", $query_data_release);

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
                  <h4><?php echo $data_release[0]['nomeRelease']; ?></h4>
               </div>
               <div class="card-body">
                  <div class="row">
                        <table class="table table-user-information">
                           <tbody>
                              <td>Casa discografica:</td>
                              <td><?php if (isset($data_release[0]['casa'])) echo '<a href="http://localhost/musicontology/casaDiscografica.php?id='.str_replace("#", "à", $data_release[0]['casa']).'">'.$data_release[0]['nomeCasa'].'</a>'?></td>
                              </tr>
                              <tr>
                              <tr>
                                 <td>Data pubblicazione:</td>
                                 <td><?php if (isset($data_release[0]['data'])) echo $data_release[0]['data']; ?></td>
                              </tr>
                              <tr>
                                 <td>Supporto:</td>
                                 <td><?php
                                    foreach ($data_release as $release) {
                                      echo $release['supporto'];
                                      echo "<br>";
                                    }
                                    ?></td>
                              </tr>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
            </div>
         </div>
      </div>
   </body>
</html>
<?php 
   /**
   * In questo file gestisco la pagina relativa alle tracce musicali.
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
   * Questa sezione e' dedicata all'estrazione dei dati relativi alle tracce musicali, agli album in cui esse sono pubblicate e agli artisti che le hanno performate.
   */
   
   
   $data_traccia = sparql_get("http://localhost:7200/repositories/TMO", $query_data_traccia);
   $gruppi = sparql_get("http://localhost:7200/repositories/TMO", $query_gruppi_traccia);
   $solo = sparql_get("http://localhost:7200/repositories/TMO", $query_solo_traccia);
   $performer_solo = sparql_get("http://localhost:7200/repositories/TMO", $query_performer_solo);
   $performer_gruppo = sparql_get("http://localhost:7200/repositories/TMO", $query_performer_gruppo);
   $data_canzone = sparql_get("http://localhost:7200/repositories/TMO", $query_data_canzone);
   $data_generi_traccia = sparql_get("http://localhost:7200/repositories/TMO", $query_generi_traccia);
   $data_release_traccia = sparql_get("http://localhost:7200/repositories/TMO", $query_release_traccia);
   $data_album_traccia = sparql_get("http://localhost:7200/repositories/TMO", $query_album_traccia);
   $data_album_traccia_precSuc = sparql_get("http://localhost:7200/repositories/TMO", $query_traccia_prec_succ);

   
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
                  <h4><?php echo $data_traccia[0]['titoloTraccia']; ?></h4>
               </div>
               <div class="card-body">
                  <div class="row">
                     <table class="table table-user-information">
                        <tbody>
                           <td>Album:</td>
                           <td><?php if (isset($data_album_traccia[0]['nomeAlbum']))  { echo '<a href="http://localhost/musicontology/album.php?id='.str_replace("#", "à", $data_album_traccia[0]['album']).'">'.$data_album_traccia[0]['nomeAlbum'].'</a>'; } else { print "---"; } ?></td>
                           </tr>
                           <tr>
                              <td>Traccia precedente:</td>
                              <td><?php if (isset($data_album_traccia_precSuc[0]['precedente'])) {echo '<a href="http://localhost/musicontology/traccia.php?id='.str_replace("#", "à", $data_album_traccia_precSuc[0]['precedente']).'">'.$data_album_traccia_precSuc[0]['nomePrecedente'].'</a>'; } else { print "---"; }?></td>
                           </tr>
                           <tr>
                              <td>Traccia successiva:</td>
                              <td><?php if (isset($data_album_traccia_precSuc[0]['successiva'])) { echo '<a href="http://localhost/musicontology/traccia.php?id='.str_replace("#", "à", $data_album_traccia_precSuc[0]['successiva']).'">'.$data_album_traccia_precSuc[0]['nomeSuccessiva'].'</a>'; } else { print "---"; }?></td>
                           </tr>
                           <tr>
                              <td>Release:</td>
                              <td><?php 
                                 if (isset($data_release_traccia[0]['release']))  { print '<a href="http://localhost/musicontology/release.php?id='.str_replace("#", "à", $data_release_traccia[0]['release']).'">'.$data_release_traccia[0]['nomeRelease'].'</a>'; } else { print "---"; }
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
                           </tr>
                           <tr>
                              <td>Featuring:</td>
                              <td><?php
                                 foreach ($gruppi as $gruppo) {
                                  $name++;
                                   print '<a href="http://localhost/musicontology/gruppo.php?id='.str_replace("#", "à", $gruppo['artistaF']).'">'.$gruppo['artistaFNome'].'</a>';
                                   print '<br>';
                                 
                                 }
                                 foreach ($solo as $solo_row) {
                                  $name++;
                                   print '<a href="http://localhost/musicontology/artista.php?id='.str_replace("#", "à", $solo_row['artistaF']).'">'.$solo_row['artistaFNome'].'</a>';
                                   print '<br>';
                                 }
                                 if ($name==0) print "---";
                                 ?>
                                 </td>
                           </tr>
                           <td>Durata:</td>
                           <td><?php if (isset($data_traccia[0]['durata'])) echo gmdate("i:s", $data_traccia[0]['durata']); ?>
                           </td>
                           </tr>
                           <tr>
                              <td>Genere:</td>
                              <td><?php foreach ($data_generi_traccia as $data) {
                                 print '<a href="http://localhost/musicontology/genere.php?id='.$data['genere'].'">'.$data['genere'].'</a>';
                                 print '<br>';
                                 } ?></td>
                           </tr>
                           <td>Scala:</td>
                           <td><?php if (isset($data_traccia[0]['scala'])) echo $data_traccia[0]['scala']; ?>
                           </td>
                           </tr>
                           <td>BPM:</td>
                           <td><?php if (isset($data_traccia[0]['bpm'])) echo $data_traccia[0]['bpm']; ?>
                           </td>
                           </tr>
                           <tr>
                              <td>Canzone:</td>
                              <td><?php echo '<a href="http://localhost/musicontology/canzone.php?id='.str_replace("#", "à", $data_traccia[0]['canzone']).'">'.$data_traccia[0]['nomeCanzone'].'</a>'; ?>
                              </td>
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
<?php 
   /**
   * In questo file gestisco la pagina relativa agli artisti.
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
   * Questa sezione e' dedicata all'estrazione dei dati relativi agli artisti e alle loro relative trace, nonche' agli album da loro pubblicati.
   */
   
   
     $data_wd = sparql_get("http://localhost:7200/repositories/TMO", $query_solo_wikidata)[0];
     $data_album = sparql_get("http://localhost:7200/repositories/TMO", $query_album);
     $data_etichetta = sparql_get("http://localhost:7200/repositories/TMO", $query_etichetta);
     $data_gruppi = sparql_get("http://localhost:7200/repositories/TMO", $query_faParteDiGruppo);
     $data_nomeArtista = sparql_get("http://localhost:7200/repositories/TMO", $query_nomeArtista)[0];
     $data_generiArtista = sparql_get("http://localhost:7200/repositories/TMO", $query_generiArtistaOntologia);
     $data_queryGenereTot = sparql_get("http://localhost:7200/repositories/TMO", $query_genere_tot);
     $data_singoli = sparql_get("http://localhost:7200/repositories/TMO", $query_singoli_pubblicati);

     if (!isset($data_wd['birthname'])) $data_wd['birthname'] = $data_nomeArtista['nome'];
     if (!isset($data_wd['immagine'])) $data_wd['immagine'] = "http://localhost/musicontology/noperson.png";

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
                  <h4><?php echo $data_nomeArtista['nome']; ?></h4>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="<?php echo $data_wd['immagine']; ?>" class="img-circle img-fluid"> </div>
                     <div class=" col-md-9 col-lg-9 ">
                        <table class="table table-user-information">
                           <tbody>
                              <tr>
                                 <td>Nome completo:</td>
                                 <td><?php echo $data_wd['birthname']; ?></td>
                              </tr>
                              <tr>
                                 <td>Sesso:</td>
                                 <td><?php echo getWikiDataLabel($data_wd['sesso']); ?></td>
                              </tr>
                              <tr>
                                 <td>Nazione:</td>
                                 <td><?php echo getWikiDataLabel($data_wd['cittadinanza']); ?></td>
                              </tr>
                              <tr>
                              <tr>
                                 <td>Casa discografica:</td>
                                 <td><?php 
                                    foreach ($data_etichetta as $solo) {
                                      print '<a href="http://localhost/musicontology/casaDiscografica.php?id='.str_replace("#", "à", $solo['casaDiscografica']).'">'.$solo['nomeEtichetta'].'</a>';
                                      print '<br>';
                                    }
                                    ?></td>
                              </tr>
                              <tr>
                                 <td>Generi:</td>
                                 <td><?php 
                                    foreach ($data_queryGenereTot as $solo) {
                                      print '<a href="http://localhost/musicontology/genere.php?id='.$solo['genere'].'">'.$solo['genere'].'</a>';
                                      print '<br>';
                                    }
                                    ?></td>
                              </tr>
                              <tr>
                                 <td>Membro di:</td>
                                 <td><?php 
                                    $i=0;   
                                    foreach ($data_gruppi as $solo) {
                                      $i++;
                                      print '<a href="http://localhost/musicontology/gruppo.php?id='.str_replace("#", "à", $solo['gruppo']).'">'.str_replace("_", " ", str_replace("http://www.semanticweb.org/bruno/ontologies/2020/1/music_ontology#", "", $solo['gruppo'])).'</a>';
                                      print '<br>';
                                    } if ($i==0) print '----';
                                    ?></td>
                              </tr>
                              <td>Album pubblicati:</td>
                              <td><?php 
                                 foreach ($data_album as $solo) {
                                   print '<a href="http://localhost/musicontology/album.php?id='.str_replace("#", "à", $solo['album']).'">'.$solo['nomeAlbum'].'</a>';
                                   print '<br>';
                                 }
                                 ?>
                              </td>
                              </tr>
                              <tr>
                              <td>Singoli pubblicati:</td>
                              <td><?php 
                                 $i=0;
                                 foreach ($data_singoli as $solo) {
                                   $i++;
                                   print '<a href="http://localhost/musicontology/traccia.php?id='.str_replace("#", "à", $solo['traccia']).'">'.$solo['nomeTraccia'].'</a>';
                                   print '<br>';
                                 } if ($i==0) print "---";
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
                  <span class="pull-right">
                  <a href="https://open.spotify.com/artist/ <?php echo $data_wd['spotify']; ?>"<?php if(empty($data_wd['spotify'])) { echo 'class="btn btn-info disabled"'; } else { echo 'class="btn btn-success"'; }?> ><i class="fa fa-spotify"></i> Spotify</a>
                  <a href="https://www.instagram.com/<?php echo $data_wd['instagram']; ?>" <?php if(empty($data_wd['instagram'])) { echo 'class="btn btn-info disabled"'; } else { echo 'class="btn btn-danger"'; }?> ><i class="fa fa-instagram"></i> Instagram</a>
                  </span>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>
<html>
   <header>
      <title>The Music Ontology</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
      <style>
         .form-control-borderless {border: none;}
         .form-control-borderless:hover, .form-control-borderless:active, .form-control-borderless:focus {border: none; outline: none; box-shadow: none;}
      </style>
   </header>
   <body style="background-color: #F0F0F0">
      <div class="container h-100">
         <div class="row h-100 justify-content-center align-items-center">
            <div class="col-12 col-md-10 col-lg-8 vcenter">
               <div class="row mb-3" >
                  <div class="col-12 text-center">
                     <img src="http://localhost/musicontology/logo.png" alt="logo">
                  </div>
               </div>
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
      </div>
   </body>
</html>
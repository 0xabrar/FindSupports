<!DOCTYPE html>
<html>
<head>
  <title>Find Me A Support - League of Legends</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <!-- Bootstrap -->  
  <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Cinzel|Montserrat' rel='stylesheet' type='text/css'>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
      </head>
      <body>
        <style> body {background-image:url("/images/background.png"); background-repeat: no-repeat; background-size: cover } </style>

        <div class ="container" style="margin-top:12%">
          <div class="center-block">
            <!-- The div that holds the title -->
            <div class="center-block">
              <a href ="/index.php"> <img src="images/logo.png" class="center-block"> 
              </img> </a>
            </div>
          </div>
        </div>

        <div class="container">
          <div class="col-md-8 col-md-offset-2">
            <div class="col-lg-12">
               <form class="input-group" role="form" method="get" action="results.php">
                  <input type="text" class="form-control form-inline" id="summonerSearchBar" placeholder="Enter your summoner name" name="summoner">
                      <div class="input-group-btn">
                        <select name="region" class="btn btn-default dropdown-toggle" id="regionDropdown" data-toggle="dropdown">
                          <option selected="selected" value="na"> NA </option>
                          <option value="eune"> EUNE </option>
                          <option value="euw"> EUW </option>
                        </select>
                               &nbsp;
                               &nbsp;       
                            <button class="btn btn-info" id="searchButton" type="submit">Search</button>
                      </div><!-- /btn-group -->
                      
                    </form>
               </div><!-- /input-group -->
           </div><!-- /.col-lg-6 -->
         </div>
       </div>
       <!-- TODO: wtf raunaq there's some clear as hell inconsistency if I have to do this bullshit -->
       <br><br><br><br><br><br><br><br><br><br><br><br>
       <?php
       include_once('footer.php'); 
       ?>
       <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
       <script src="https://code.jquery.com/jquery.js"></script>
       <!-- Include all compiled plugins (below), or include individual files as needed -->
       <script src="bootstrap/js/bootstrap.min.js"></script>
     </body>
     </html>

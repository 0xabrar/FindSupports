<<<<<<< HEAD:main.html
<!DOCTYPE html>
<html>
<?php 
  $summoner_name = $_GET["summoner"];
  $processed = exec("python call_summoner_info.py .$summoner_name");
  echo $processed;

  function getResultsPage(){
    window.location.href = "results.html";
  }
?>
  <head>
    <title>Find Me A Support League of Legends</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <style> body {background-image:url('Images/BackGround.jpg'); background-repeat: no-repeat; background-size: cover } </style>

    <div class ="container" style="margin-top:10%">
      <div class="center-block">
        <!-- The div that holds the title -->
        <div class="center-block">
          <a href ="main.html"> <img src="images/logo.png" class="center-block"> 
          </img> </a>
        </div>
      </div>
    </div>
    <p style="text-align:center; font-style:italic; color:#FFFFFF">Get access to a list of all the support players near your skill level! All you have to do is enter in your summoner name and click search!</p>
    <br></br>

  <div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="col-lg-12">
          <form class="input-group form-inline" role="form" method="POST" action="results.html" id="summoner" onSubmit="getResultsPage()">
            <input type="text" class="form-control" placeholder="Enter your summoner name here">
            <span class="input-group-btn">
               <button class="btn btn-info" type="submit">Search</button>
            </span>
          </form><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </div>
  </div>
  <div style="position:relative; text-align:center;">
    <p style="position:fixed; bottom:0px; font-size:0.8em; width:100%; color:#B5B5B5"><small>Find Me a Support isn’t endorsed by Riot Games and doesn’t reflect the views or opinions of Riot Games or anyone officially involved in producing or managing League of Legends. League of Legends and Riot Games are trademarks or registered trademarks of Riot Games, Inc. League of Legends © Riot Games, Inc.
      <small></p>  
  </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
=======
<!DOCTYPE html>
<html>
  <head>
    <title>Find Me A Support League of Legends</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <style> body {background-image:url('Images/BackGround.jpg'); background-repeat: no-repeat; background-size: cover } </style>

    <div class ="container" style="margin-top:10%">
      <div class="center-block">
        <!-- The div that holds the title -->
        <div class="center-block">
          <a href ="main.html"> <img src="images/logo.png" class="center-block"> 
          </img> </a>
        </div>
      </div>
    </div>
    <p style="text-align:center; font-style:bold; color:#FFFFFF">Get access to a list of all the support players near your skill level! Just search.</p>
    <br></br>

  <div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="col-lg-12">
          <form class="input-group form-inline" role="form" method="POST" action="get_data.php" >
            <input type="text" class="form-control" placeholder="Enter your summoner name here" name="summoner">
            <span class="input-group-btn">
               <button class="btn btn-info" type="submit">Search</button>
            </span>
          </form><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </div>
  </div>
  <div style="position:relative; text-align:center;">
    <p style="position:fixed; bottom:0px; font-size:0.8em; width:100%; color:#B5B5B5"><small>Find Me a Support isn’t endorsed by Riot Games and doesn’t reflect the views or opinions of Riot Games or anyone officially involved in producing or managing League of Legends. League of Legends and Riot Games are trademarks or registered trademarks of Riot Games, Inc. League of Legends © Riot Games, Inc.
      <small></p>  
  </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
>>>>>>> a6b48e7726dd929aaaafb789a79407d8bc3aadd4:index.php
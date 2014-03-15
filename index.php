<!DOCTYPE html>
<html>
  <head>
    <title>Find Me A Support League of Legends</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <style> body { background: url(./images/background.png) no-repeat center center fixed; 
                      -webkit-background-size: cover;
                      -moz-background-size: cover;
                      -o-background-size: cover;
                      background-size: cover;
                    }  
            </style>

    <div class ="container" style="margin-top:12%">
      <div class="center-block">
        <!-- The div that holds the title -->
        <div class="center-block">
          <a href ="index.php"> <img src="images/logo.png" class="center-block"> 
          </img> </a>
        </div>
      </div>
    </div>

  <div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="col-lg-12">
          <form class="input-group form-inline" role="form" method="get" action="scratch.php">
            <input type="text" class="form-control" placeholder="Enter your summoner name here" name="summoner"> 
            <span class="input-group-btn">
               <button class="btn btn-info" type="submit">Search</button>
            </span>
          </form><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </div>
  </div>
  <div style="position:relative; text-align:center;">
    <p style="position:fixed; bottom:0px; font-size:0.8em; width:100%; color:#B5B5B5"><small>FindMeASupport isn’t endorsed by Riot Games and doesn’t reflect the views or opinions of Riot Games or anyone officially involved in producing or managing League of Legends. League of Legends and Riot Games are trademarks or registered trademarks of Riot Games, Inc. League of Legends © Riot Games, Inc.
      <small></p>  
  </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>

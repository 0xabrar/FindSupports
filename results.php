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

    


    <style> body {background-image:url("./images/background.png"); background-repeat: no-repeat; background-size: cover } </style>

    <div class ="container" style="margin-top:10%">
      <div class="center-block">
        <!-- The div that holds the title -->
        <div class="center-block">
          <a href ="index.php"> <img src="images/logo.png" class="center-block"> 
          </img> </a>
        </div>
      </div>
    </div>
  

    <div class ="container" style="margin-top:0%">
      <div class="center-block">
        <!-- The div that holds the title -->
        <div class="center-block">
          <table class="table table-striped table-bordered table-condensed table-hover">  
          <thead>  
            <tr>  
              <th>Summoner Name</th>  
              <th>Games Played</th>  
              <th>Games Won</th>  
              <th>Win %</th>  
              <th>Total Assists</th>  
              <th>Most Played Champion</th>
              <th>LolKing Profile</th>
            </tr>  
          </thead>  
          <tbody>  
            <tr>  
              <td>001</td>  
              <td>Rammohan </td>  
              <td>Reddy</td>  
              <td>A+</td>   
              <td>A+</td>   
              <td>A+</td> 
              <td>google.ca</td> 
            </tr>  
            <tr>  
              <td>002</td>  
              <td><?php echo $_GET["summoner"]; ?></td>  
              <td>Pallod</td>  
              <td>A</td>   
              <td>A+</td>   
              <td>A+</td>
              <td>google.ca</td> 
            </tr>  
            <tr>  
              <td>003</td>  
              <td>Rabindranath</td>  
              <td>Sen</td>  
              <td>A+</td>   
              <td>A+</td>   
              <td>A+</td>
              <td>google.ca</td>  
            </tr>  
            <tr>  
              <td>004</td>  
              <td>Rabindranath</td>  
              <td>Sen</td>  
              <td>A+</td>  
              <td>A+</td>   
              <td>A+</td>
              <td>google.ca</td>   
            </tr> 
            <tr>  
              <td>005</td>  
              <td>Rabindranath</td>  
              <td>Sen</td>  
              <td>A+</td>   
              <td>A+</td>   
              <td>A+</td>
              <td>google.ca</td>  
            </tr> 
          </tbody>  
          </table>
        </div>
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
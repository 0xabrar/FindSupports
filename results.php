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
    <style> 
    body { background: url(/images/results_background.png) no-repeat center center fixed; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    } 
    </style>

    <div class ="container" style="margin-top:10%">
      <div class="center-block">
        <!-- The div that holds the title -->
        <div class="center-block">
          <br><br>
          <a href ="/index.php"> <img src="/images/logo.png" class="center-block"> 
          </img> </a>
        </div>
      </div>
    </div>
    

    <div class ="container" style="margin-top:0%">
      <div class="center-block">
        <!-- The div that holds the title -->
        <div class="center-block">

          <table class="table table-striped table-bordered table-condensed table-hover" 
          style="border-color:black; width:75%; margin-left:auto ; margin-right: auto;">  
          <thead>  
            <tr>  
              <th><center>Summoner Name</center></th>  
              <th><center>Games Played</center></th>  
              <th><center>Games Won</center></th>  
              <th><center>Win %</center></th>  
              <th><center>Average Assists</center></th>  
              <th><center>Most Played Support</center></th>
            </thead>


            <tbody>
              <?php

              include('playersystem/player_system.php'); 
              //TODO: make different regions function for api calls
              $summoner_name = $_GET["summoner"];
              $playerSystem = new PlayerSystem($summoner_name, "na");

              for ($i = 0; $i < 10; $i++) {
                $player = $playerSystem->get_player($i);

                //At least 10 players must exist. The object may be null.
                if ($player != null) {
                  $playerName = $player->get_name();
                  $playerPlayed = $player->get_games_played();
                  $playerWon = $player->get_games_won();
                  $playerPercent = $player->get_win_percent();
                  $playerAssists = $player->get_avg_assists();
                  $playerChampion = $player->get_most_played_support();
                  $playerProfile = $player->get_lolking();


                  echo"<tr  height=\"50\"> ";
                  echo "<td style=\"vertical-align: middle\"><center><a href=\"" .$playerProfile. "\">" .$playerName. "</a></center></td>";
                  echo "<td style=\"vertical-align: middle\"><center>" .$playerPlayed. "</center></td>";
                  echo "<td style=\"vertical-align: middle\"><center>" .$playerWon. "</center></td>";
                  echo "<td style=\"vertical-align: middle\"><center>" .$playerPercent. "</center></td>";
                  echo "<td style=\"vertical-align: middle\"><center>" .$playerAssists. "</center></td>";
                  echo "<td style=\"vertical-align: middle\"><img src=\"images/champion_icons/janna.png\" height=\"40\" width=\"40\" style=\"margin-left:8%;\"><div style=\"display:inline; margin-left:2em;\">"  .$playerChampion. "</div></td>";
                  echo "</tr>";       
                }
                
              }?>

            </tbody>  
          </table>
        </div>
      </div>
    </div>

    <?php 
    include('footer.php')
    ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js\"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js\"></script>
  </body> 
  </html>


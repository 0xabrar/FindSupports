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
        <style> body {background-image:url("/images/background.png"); background-attachment: fixed; background-repeat: no-repeat; -moz-background-size:100% 100%; background-size:100% 100%; } </style>

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
             <form id="summonerForm" class="input-group" role="form" method="get" action="error_checker.php">
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

      <br>
      <!-- Error message box -->
      <div id = "errorMessage"><center>
        <table style="background-color: black; border: 0px; border-radius: 10px; box-shadow: 0px 0px 5px black;" >
          <tr>
            <td id = "message" style="padding: 5px; color:#B5B5B5;"></td>
          </tr> 
        </table></center>
      </div>
    </div>



    
    <?php
    include_once('footer.php'); 
    ?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>


    <script type='text/javascript'>
    //Scripts for handling errors with the user's input.

    //Error message is hidden by default.
    $(document).ready(function(){
      $("#errorMessage").hide();
    });


    //Call this material when users submit the summoner form.
    $("#summonerForm").submit(function(event) {
      /* stop form from submitting normally */
      event.preventDefault();
      /* Send the data to be verified that it is correct as a summoner. */
      $.get( "error_checker.php", { summoner: $('#summonerSearchBar').val(), region: $('#regionDropdown').val() }, function(data) {
      //Checks if the returned data contains an error. 
      var contains = (data.indexOf('error')) >  -1;
      if (!contains) {
        window.location="results.php?" + data;
      } else {
        var json = JSON.parse(data);
        var error = json['error'];
        handle_error(error);
      }
    });
    });

  //Based on the error raised, change the error info given.
  function handle_error(error) {
    if (error == 'empty_name') {
      document.getElementById("message").innerHTML = "Please enter a  summoner name.";
    } else if (error == 'no_summoner') {
      document.getElementById("message").innerHTML = "That is not a valid summoner. Check spelling and region.";
    } else if (error == 'under30') {
      document.getElementById("message").innerHTML = "The summoner must be level 30.";
    } else if (error == 'rate_limit') {
      document.getElementById("message").innerHTML = "The server is reaching capacity. Please wait a while.";
    }
    display_error();
  }

  //Display the error box.
  function display_error() {
    $("#errorMessage").fadeIn(500);
    setTimeout(function() {$("#errorMessage").fadeOut(500);}, 2000);
  }




  </script>


</body>
</html>

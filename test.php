<!DOCTYPE html>
<html>
<head>
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>

  <form id="summonerForm" action="error_checker.php" method="get" >
    <input type="text" placeholder="Enter your summoner name" id="summoner" name="summoner">
    <select id="region" name="region">
      <option value="na">NA</option>
      <option value="eu">EU</option>
      <option value="eune">EUNE</option>
    </select>       
    <button type="submit" id="submitButton">Search</button>
  </form>


  <div id = "errorMessage">
    <table style="border: 1px solid black;" >
      <tr>
        <td>Error message to display.</td>
      </tr>
    </table>
  </div>

  <?php
/*
define('SERV_ROOT', '/var/www/html');
include(SERV_ROOT . '/playersystem/player_system.php');
echo "<br><br>";
$playersystem = new PlayerSystem("asdsdsasd", "na");


for ($i = 0; $i < 10; $i++) {
  $player = $playersystem->get_player($i);
}*/?>

<script type='text/javascript'>
/* attach a submit handler to the form */

//Error message is hidden by default.
$(document).ready(function(){
  $("#errorMessage").hide();
});


//Call this material when users submit the summoner form.
$("#summonerForm").submit(function(event) {
  /* stop form from submitting normally */
  event.preventDefault();
  /* Send the data to be verified that it is correct as a summoner. */
  $.get( "error_checker.php", { summoner: $('#summoner').val(), region: $('#region').val() }, function(data) {
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
    document.getElementById("errorMessage").innerHTML = "Please enter a summoner name.";
  } else if (error == 'no_summoner') {
    document.getElementById("errorMessage").innerHTML = "That is not a valid summoner. Check spelling and region!";
  } else if (error == 'under30') {
    document.getElementById("errorMessage").innerHTML = "The summoner must be level 30.";
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







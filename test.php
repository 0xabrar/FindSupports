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

    $(document).ready(function(){
        $("#errorMessage").hide();
    });
    

    $("#summonerForm").submit(function(event) {

      /* stop form from submitting normally */
      event.preventDefault();

      /* get some values from elements on the page: */
      var $form = $( this ),
          url = $form.attr( 'action' );

      /* Send the data using get */
      var posting = $.post( "error_checker.php", { summoner: $('#summoner').val(), region: $('#region').val() } );

      /* Put the results in a div */
      posting.done(function( data ) {
        if (data == "fuck me") {
          $("#errorMessage").fadeIn(500);
          document.getElementById("errorMessage").innerHTML = data;
          setTimeout(function() {$("#errorMessage").fadeOut(500);}, 2000);
        } else {
          document.getElementById("errorMessage").innerHTML="what";
        }
        

      });



    });
</script>

</body>
</html> 







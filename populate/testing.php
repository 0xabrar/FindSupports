<!DOCTYPE html>
<html>
<head>
    <title>Find Me A Support League of Legends</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<?php

	include('player_system.php');
    //Add in summoners to db
    
	for ($i = 34558500; $i < 35598500; $i++) {
        $player = new PlayerSystem($i, "na");
        sleep(5);
    }  

	
?>



</body>
</html>
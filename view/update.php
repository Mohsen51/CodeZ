<?php
//file_get_contents("php://input")
$data = json_decode('{ "player_pseudo":"bbb", "player_id":"1"}');
var_dump(count($data));

if(count($data)> 0 ){
			echo '1';
			$servername = "localhost";
			$username = "root";
			$passwordDB = "root";

				try {

			    $conn = new PDO("mysql:host=$servername;dbname=tournament_generator", $username, $passwordDB);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    echo 'connected';
		  		}
				catch(PDOException $e)
			    {
			    echo "Connection failed: " . $e->getMessage();
			    }

	 			//$player_pseudo = mysqli_real_escape_string($connect, $data->player_pseudo);
	 			//$player_id = mysqli_real_escape_string($connect, $data->player_id);

	 			echo $player_pseudo;
			    $req = $conn->prepare("UPDATE player SET player_pseudo = ? where player_id = ?");
			    $req->execute(array($player_pseudo,$player_id));
			    echo 'NICE';

		  }


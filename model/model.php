<?php
function dBconnect(){
	

	$servername = "localhost";
		$username = "root";
		$passwordDB = "";

		try {

		    $conn = new PDO("mysql:host=$servername;dbname=tournament_generator", $username, $passwordDB);
		    // set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		   // echo "Connected successfully"; 
		    return $conn;
	  		}
			catch(PDOException $e)
		    {
		    echo "Connection failed: " . $e->getMessage();
		    }
}





function sanitarise($data){
	 $re = '/[^a-zA-Z0-9]/';
	 $santarised_data = preg_replace($re, "", $data);
	    return  $santarised_data;
	 /*
	 $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);*/
     //ça hesite sévère
}


function addName($size,$arrIn){
	
		$conn = dBconnect();
		$arr = [];	
		for($i=0;$i<$size;$i++){
			
		    $req = $conn->prepare("INSERT INTO  player(player_pseudo) VALUES (?)");    
		    $req->execute(array($arrIn[$i]));
		  	$arr[] = $conn->lastInsertId();
			}	
			
		return $arr;

			
	}

function initTree($size,$id_owner,$arr2,$name_tree){

	$id_player = addName( $size,$arr2);
	$id_tree = addTre( $size,$id_owner,$name_tree);
	
	$conn = dBconnect();
	
	for($i=1;$i<=($size);$i++){
		   $req = $conn->prepare("INSERT INTO three_position( three_id, player_id, c0lumn, row) VALUES ( :three_id, :player_id, '1', :row)");  
		   $req->bindParam(':three_id', $id_tree);
	   	   $req->bindParam(':player_id', $id_player[($i-1)]); 
	   	   $req->bindParam(':row', $i); 
	       $req->execute();
	       
	   }
	
	return $id_tree;
	
	

}



function addTre($size,$id_owner,$name_tree){
		
		$conn = dBconnect();
		
		$index = $name_tree.$id_owner;
		$hash = hash('sha256', $index);
		$token = substr($hash,0,20);
	
		$req = $conn->prepare("INSERT INTO  three(three_owner,three_size,three_name,token)  VALUES (:three_owner, :three_size,:three_name,:token)");
	    $req->bindParam(':three_owner', $id_owner);
	    $req->bindParam(':three_size', $size);
	    $req->bindParam(':three_name', $name_tree);
	    $req->bindParam(':token', $token);
	    $req->execute();
	    
	    return $conn->lastInsertId();
		
}

function selectOwner($name){

		$conn = dBconnect();
		$req = $conn->prepare("SELECT owner_id FROM owner WHERE owner_pseudo = ? ");    
		$req->execute(array($name));

		while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

  			$arr[] = $row;
		}

		return $arr['0']['owner_id'];
		

}

function selectSize($three_id){
		$conn = dBconnect();
		$req = $conn->prepare("SELECT three_size FROM three WHERE three_id = ? ");    
		$req->execute(array($three_id));

		while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

  			$arr[] = $row;
		}

		return $arr['0']['three_size'];
		
}


function selectDataForJs($tree_id,$bol){
	$conn = dBconnect();
	$arr = [];
	
	$req = $conn->prepare("SELECT player.player_pseudo, three_position.c0lumn, three_position.row
								FROM player
								INNER JOIN three_position ON three_position.player_id = player.player_id
								WHERE three_position.three_id = ?");
	$req->execute(array($tree_id));


     while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
	 	$arr[] = $row;
	 	}

	 if($bol==0){
	 	 echo json_encode($arr);
		}
	else{
		return $arr;
	}
	
}

function udpateDataForJs($data){
	$conn = dBconnect();


	$player_pseudo =  $data->player_pseudo;
	$player_id =  $data->id;

	$req = $conn->prepare("UPDATE player SET player_pseudo = :pseudo where player_id = :id ");
	$req->bindParam(':pseudo', $player_pseudo);
	$req->bindParam(':id', $player_id);
    $req->execute();

}

function udpatePosition($data,$tree_id){
	$conn = dBconnect();
	$arr = [];
	$column =  $data->column;
	$row =  $data->row;
	$three_size = selectSize($tree_id);
	if($three_size == 24 and $column == 4){
		$newrow = 1;
	}
	elseif($row%2 == 0){
		$newrow = $row/2;
	}
	elseif($row%2 == 1){
	
		$newrow = $row-floor($row/2);
	}
	else{
		echo 'errror';
	}

	$newcolumn = $column +1;

	$req = $conn->prepare("SELECT player_id FROM three_position  
		WHERE (three_id = :id AND  ((row = :row AND c0lumn = :c0lumn) OR (row = :newrow AND c0lumn = :newcolumn)) )");
	$req->bindParam(':id', $tree_id);
	$req->bindParam(':row', $row);
	$req->bindParam(':c0lumn', $column);
	$req->bindParam(':newcolumn', $newcolumn);
	$req->bindParam(':newrow', $newrow);
	$req->execute();

	 while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
	 	$arr[] = $row;
	 	}
	 	

	 //check if the case is already filled
	 if($arr[1]['player_id'] != NULL){
	 	echo 'error: case already filled';
	 }
	 else{
		 
		//SELECT t.player_id FROM (SELECT player_id,row,c0lumn,three_id FROM three_position) t WHERE(t.three_id = :id AND  t.row = :row AND t.c0lumn = :c0lumn))
		$req = $conn->prepare("INSERT INTO three_position( three_id, player_id, c0lumn, row) VALUES (:id_tree,:id_player,:newcolumn,:newrow) ");
		
		$req->bindParam(':newcolumn', $newcolumn);
		$req->bindParam(':newrow', $newrow);
		$req->bindParam(':id_tree', $tree_id);
		$req->bindParam(':id_player', $arr[0]['player_id']);
		
	    $req->execute();
	   }
	    
  

}

function selectTreeUSer($id_owner){
	$conn = dBconnect();
	$arr = [];
	$req = $conn->prepare("SELECT three_name,three_size,token FROM three WHERE three_owner = :owner_id ");
	$req->bindParam(':owner_id', $id_owner);
	$req->execute();
	
	while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
	 	$arr[] = $row;
	 	}
	 return $arr;

}



function selectTreeWithToken($token){
	$conn = dBconnect();
	$arr = [];
	$req = $conn->prepare("SELECT three_id,three_size,three_name FROM three WHERE token = :token ");
	$req->bindParam(':token', $token);
	$req->execute();
	
	while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
	 	$arr[] = $row;
	 	}
	 return $arr;
}

function checkIfTreeAlreadyExist($tree_name){
	$conn = dBconnect();
	$arr = [];
	$req = $conn->prepare("SELECT three_size FROM three WHERE three_name = :name ");
	$req->bindParam(':name', $tree_name);
	$req->execute();
	while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
	 	$arr[] = $row;
	 	}

	if($arr != NULL){
		return 1;
	}
	else{
		return 0;
	}
}









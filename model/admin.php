<?php
function inscriptionUser($pseudo,$hash){

		$conn = dBconnect();

	    $req = $conn->prepare("INSERT INTO owner (owner_pseudo,owner_pass) 
	    VALUES (:owner_pseudo, :owner_pass )");
	    $req->bindParam(':owner_pseudo', $pseudo);
	    $req->bindParam(':owner_pass', $hash);
	    $req->execute();
		
}

function connectionUser($pseudo){
		$conn = dBconnect();
		$arr = [];
	    $req = $conn->prepare("SELECT owner_pass,owner_id FROM owner WHERE owner_pseudo = ?");    
	    $req->execute(array($pseudo));

	    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
  		$arr[] = $row;
		}

		$req = null;
		return $arr;

}

function checkUserName($pseudo){
		$conn = dBconnect();	
		$arr = [];	
		$req = $conn->prepare("SELECT owner_id FROM owner where owner_pseudo = :pseudo");
		$req->bindParam(':pseudo', $pseudo);
		 $req->execute();
		while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
  		$arr[] = $row;
		}
		
		if($arr == NULL){
			return 0;
		}
		else{
			return 1;
		}
}
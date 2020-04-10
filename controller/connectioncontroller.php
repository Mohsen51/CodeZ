<?php

session_start();
session_regenerate_id();



require('model/model.php');

function connection(){
	require('view/connectionUserView.php');
}

function inscription(){
	require('view/inscriptionUserView.php');
}
function displaydata(){
	require('view/generateTreeView.php');
}
function createTree(){
	require('view/createTree.php');
}

function selecDataForJsVerification(){
	selectDataForJs($_SESSION['current_tree']);
}

function updatecDataForJsVerification($data){
	updateDataForJs($data);
}

function displaydatareq(){
	getData();
}

function createVerification($arr,$size){

	$size = sanitarise($size);
	// sanitarise

	$id_tree = initTree($size,'antonin',$arr);


	$_SESSION['size_tree']=$size;
	$_SESSION['current_tree']=$id_tree;

	header('Location: view/generateTreeView.php');

}
	

function connectionVerification($pseudo,$password){
	//sanitarize inputs
	$pseudo = sanitarise($pseudo);
	$password = sanitarise($password);
	
	//hash of the password
	$supposed_pass = $password;
	
	
	$arr = connectionUser($pseudo);
	
	if($arr != NULL){

				$expected_pass = 0;
				$owner_id = 0;
				//obselete can be easily improve
				foreach ($arr as $key => $value) {
					foreach ($value as $key2 => $value1) {
						if($i%2 == 0){
							$expected_pass = $value1;
						}
						else{
							$owner_id = $value1;
						}
						$i++;
					}
				}
			  
				//comparaison between passwords

				if(password_verify($supposed_pass,$expected_pass)){
					$_SESSION['owner_id'] = $owner_id;

					header("Location: routeur.php");
				}
				else {
					echo 'PASSWORD OR ID WRONG';
					
				}
			}
			else{
				echo 'PASSWORD OR ID WRONG 2';
				
			}
	}

function inscriptionVerification($pseudo,$password){
	$pseudo = test_input($pseudo);
	$password = test_input($password);
	
	//hash of the password
	$hash =  password_hash($password,PASSWORD_DEFAULT);

	inscriptionUser($pseudo,$password);
}

	
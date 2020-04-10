<?php

require('model/admin.php');


function connection($error){
	
	require('view/adminView/connectionUserView.php');
}

function inscription($error){
	require('view/adminView/inscriptionUserView.php');
}

function formTocreateTree($error){

	require('view/adminView/formToCreateTreeView.php');
}

function deconnection(){
	unset($_SESSION['owner_id']);
	unset($_SESSION['current_tree']);
	unset($_SESSION['size_tree']);
	session_destroy();
	printFirstpage();
}

function connectionVerification($pseudo,$password){
	//sanitarize inputs
	$pseudo = sanitarise($pseudo);
	$password = sanitarise($password);
	
	//hash of the password
	$supposed_pass = $password;
	
	$arr = connectionUser($pseudo);
	
	if($arr != NULL){

				$expected_pass = $arr[0]['owner_pass'];
				$owner_id = $arr[0]['owner_id'];
				
				
			  
				//comparaison between passwords

				if(password_verify($supposed_pass,$expected_pass)){
					$error = '';
					//init session admin id
					$_SESSION['owner_id'] = $owner_id;

					displayUserTree();
				}
				else {
					$error = 'WRONG PASSWORD OR ID';
					require('view/adminView/connectionUserView.php');
					
				}
			}
			else{
				$error = 'WRONG PASSWORD OR ID';
				require('view/adminView/connectionUserView.php');
				
			}
	}


function inscriptionVerification($pseudo,$password){
	//$pseudo = test_input($pseudo);
	//$password = test_input($password);
	$error ='';
	if(checkUserName($pseudo)){
		
		$error = "Username already exists, please give an another one ";
		inscription($error);
	}
	else{
		//hash of the password
		$hash =  password_hash($password,PASSWORD_DEFAULT);

		inscriptionUser($pseudo,$hash);
		connection('');
	}

}


	
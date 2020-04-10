<?php




require('model/model.php');


/////////////////////// DISPLAY FUNCTION ///////////////////

function tokenConnection($error){
	require('view/tokenFormView.php');
}
function displayTree($size,$token,$name){
	if($token != NULL){
	$data = selectTreeWithToken($token);
	$_SESSION['current_tree'] = $data[0]['three_id'];

	$_SESSION['size_tree'] = $data[0]['three_size'];
	$three_name =  $data[0]['three_name'];
	}
	else{
		$three_name = $name;
	}
	$three_size = sanitarise($size);
	
		


	require('view/generateTreeView.php');
}


function displayUserTree(){
	

	$data = selectTreeUser($_SESSION['owner_id']);
	
	require('view/displayUserTree.php');

}
function displayTreeWithToken($token){
	//$token = sanitarise($token);
	$data = selectTreeWithToken($token);
	
	if($data == NULL){
		tokenConnection('wrong token');
	}
	else{
		$three_id =  $data[0]['three_id'];
		$i= $data[0]['three_size'];
		$three_name = $data[0]['three_name'];
		
		
		$three_size= $i;

		
		$donne = selectDataForJs($three_id,1);
		require('view/generateTreeWithNoRightView.php');
	}
}



function createVerification($arr,$size,$name_tree){

	$check_name = checkIfTreeAlreadyExist($name_tree);
	if($check_name){
		formTocreateTree('a tree with the same user name already exist');
	}
	else{
		$id_tree = initTree($size,$_SESSION['owner_id'],$arr,$name_tree);
			
		$_SESSION['size_tree']=$size;
		$_SESSION['current_tree']=$id_tree;
		
		displayTree($size,NULL,$name_tree);
	}

}

function printFirstpage()
{
	require("view/index.php");
}



/////////////////////// Javascript REQUESTS /////////////////

function selecDataForJsVerification(){

	 selectDataForJs($_SESSION['current_tree'],0);
	
}

function updatecDataForJsVerification($data){
	if(count($data)> 0 ){
		updateDataForJs($data);
	}
}

function updatePositionVerification($data){
	
	if(count($data)> 0 ){
		
		if($data->column > $_SESSION['size_tree']){
			echo 'error : overfilled tree';
		}
		else{
			udpatePosition($data,$_SESSION['current_tree']);
		}
	}

}







	
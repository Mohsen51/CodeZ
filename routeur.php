	
	
<?php

	
session_start();
session_regenerate_id();

require('controller/controller.php');
require('controller/admin.php');

	

	////////////////////////// ADMIN FEATURES ////////////////////////////////////
	if (isset($_GET['action']) ) {

		if($_GET['action'] =='connectionVerification'){
			
			if(!empty($_POST['pseudo']) and !empty($_POST['password'])){
				
				connectionVerification($_POST['pseudo'],$_POST['password']);
				
			}
			else{
				connection('all inputs must be filled !');
			}

		}
		elseif ($_GET['action'] =='inscription'){

			inscription('');
		}
		elseif ($_GET['action'] =='connection'){

			connection('');
		}
		elseif ($_GET['action'] == 'findTree'){
			tokenConnection('');
		}
		elseif($_GET['action'] =='token'){
			if(!empty($_POST['token']))
			displayTreeWithToken($_POST['token']);
		}
		elseif ($_GET['action'] =='formToCreateTree' and empty($_SESSION['owner_id'])){
					connection('');
		}
		
		elseif ($_GET['action'] =='inscriptionVerification'){
		
			if(!empty($_POST['pseudo']) and !empty($_POST['password'])){

				inscriptionVerification($_POST['pseudo'],$_POST['password']);
			}
			else{
				inscription('all inputs must be filled !');
			}
		}

		elseif(!empty($_SESSION['owner_id'])){
			if ($_GET['action'] =='deconnection'){
					deconnection('');
			}
			elseif ($_GET['action'] =='formToCreateTree'){
					formToCreateTree('');
			}

			elseif ($_GET['action'] =='displayUserTree') {
					displayUserTree();
			}
		////////////////////////////// TREE ACTION //////////////////////////////////

			elseif ($_GET['action'] =='createTree'){
					//check before sending if inputs are fill --> critic fail -> modify request by proxy
						$i = 1;

						while(!empty($_POST[$i])){
								if(strlen($_POST[$i])> 20){
									$_POST[$i] = 'player '.$i;
								}
								$arr[] = $_POST[$i];
								$i+=1;
						
						}
						shuffle($arr);
						
						$i-=1;
						
						
						if($i != 0 AND !empty($_POST['tree_name'])){
							
							createVerification($arr,$i,$_POST['tree_name']);	

						}
						else{
							echo 'error :no data send ';
						}

					
					
			}
			elseif ($_GET['action'] =='displayTree'){
				
				if(!empty($_POST['three_size']) AND !empty($_POST['token'])){
				
					displayTree($_POST['three_size'],$_POST['token'],NULL);
				}
				else{
					echo 'error';
				}
			}
		
			elseif ($_GET['action'] == 'backToFirstPage' ){
				printFirstPage();
			}

		///////////////////////////// Javascript REQUESTS ///////////////////////////
			elseif ($_GET['action'] =='selectDataForJs'){
				
				selecDataForJsVerification();

			}
			elseif ($_GET['action'] =='updatePosition'){

				$data = json_decode(file_get_contents("php://input"));  
				updatePositionVerification($data);

			}

			

		}
		else
		{
			
			printFirstpage();
		}
	}
	else{

		printFirstpage();	
	}





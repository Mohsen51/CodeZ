<DOCTYPE>
<html>
	<head>
		<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script> 
		<link rel="stylesheet" type="text/css" href="css/style.css"> 
		<link href="css/style_connectionUserView" rel="stylesheet" type="text/css">
	</head>
	<body>
		<?php include("view/header.php"); ?>
		<div id="banner_tree">
			<body>
			<div ng-app="myApp" ng-controller="returnData" ng-init="displayData()">
				<?php generator($three_size,$three_name);?>				
			</div>
		</div>
	<?php include("view/footer.php"); ?>
	</body>
</html>

<script>
var app = angular.module('myApp', []);

app.controller('returnData', function($scope, $http) {
	
	$scope.displayData = function(){
		$http.get("routeur.php?action=selectDataForJs")
		.success(function(data){
			$scope.names = data;
			$scope.bol = 1;
			
		});
	}

	$scope.updateColor = function(column,row,spe,type) { 
		$scope.myobj = {
			"fill" : "#009900"
		}
		
		var temp;
		var bol=0;
		var name;
		var nameToBeCompare = 0;
		if(spe && column==4 ){
			temp = 1;	
		}
		else if(row%2 == 0){
			temp = row/2;
		}
		else if ( row%2 == 1 && row != undefined){
			//console.log(row);
			temp= row-Math.round(row/2)+1;
		}

		for(var key in $scope.names) {
    		if ($scope.names.hasOwnProperty(key)) {
    			if($scope.names[key].row== row && $scope.names[key].c0lumn == column){
    				name = $scope.names[key].player_pseudo;
    			}
    			if($scope.names[key].row== temp && $scope.names[key].c0lumn == (column+1)){
    				nameToBeCompare = $scope.names[key].player_pseudo;
    			}
				if(($scope.names[key].row== (row-1) && $scope.names[key].c0lumn == column) || ($scope.names[key].row== (row+1) && $scope.names[key].c0lumn == column)){
					bol=1;
				}
				
			}
    	}
    	if(name == nameToBeCompare && type==1){
    		return $scope.myobj;
    	}
		if(name == nameToBeCompare && type==2){
    		return "default_text_winner";
    	}
		if(bol==1 && type==2){	
			return "default_text_looser";
		}
    	

		
	}
	
    $scope.updatePosition = function(column,row,spe){
    	var temp;
    	var a =0;

 		if(row%2==0){
    		temp=row-1;
    	}
    	else{
    		temp=row+1;
    	}
 

    	for(var key in $scope.names) {
    		if ($scope.names.hasOwnProperty(key)) {

    			if($scope.names[key].row== temp && $scope.names[key].c0lumn == column  ){
    			 a = 1;
    	    	
    	    	}
    	    	
  			  }

		}
		if(!a && !spe && column!=4){
			console.log("error: you need an ennemy to win a battle !");
		}
		else{
			$scope.column = column;
    	$scope.row = row;

    	 $http.post(  
                    "routeur.php?action=updatePosition",  
                    {'column':column,'row':row}  
                ).success(function(){ 
                       
                    $scope.displayData();  
                });  
		}
 
    	
    	
    };
});
</script>

	<?php 

	function generator($three_size,$three_name){

				
				$nbcases = $three_size; // SEULE VARIABLE A CHANGER POUR AVOIR DES ARBRES DIFFERENTS POUR 2,4,8,16,24 OU 32 JOUEURS
				$height = 0;
				$centerize = 0;
				$counter = 0;
				$maxc0lumn = 0;
				$spe = 0;
//------------------------------------------------------------DÉFINITION DE TOUS LES CAS POSSIBLES---------------------------------------------------------------------------------------------
				switch ($nbcases){
				case 2 : 
					$maxc0lumn = 2;
					break;
				case 4 : 
					$maxc0lumn = 3;
					break;
				case 8 : 
					$maxc0lumn = 4;
					break;
				case 16 : 
					$maxc0lumn = 5;
					break;
				case 24 : 
					$maxc0lumn = 5;
					$spe = 1;
					break;
				case 32 : 
					$maxc0lumn = 6;
					break;
				default : 
					$maxc0lumn = 0;
				}


//-------------------------------------------------------------DEBUT DE LA FORMATION DE L'ARBRE-----------------------------------------------------------------------------------------------

				echo '<p class=" name">'.$three_name.'</p>'; 
				for ($c0lumn = 1; $c0lumn <= $maxc0lumn; $c0lumn++){


					echo '<svg height="'.(250+$three_size*65).'" width="15%">';

					for ($i = 0 ; $i < $nbcases ; $i++){?>

						<g  ng-click="updatePosition(<?=htmlspecialchars($c0lumn); ?>,<?=htmlspecialchars($i+1); ?>,<?=htmlspecialchars($spe); ?>)">
						<rect  ng-if="bol" ng-style="updateColor(<?=htmlspecialchars($c0lumn); ?>,<?=htmlspecialchars($i+1); ?>,<?=htmlspecialchars($spe); ?>,1)" x="0" y="<?=htmlspecialchars($height*60); ?>" width="80%" height="70" class="cinquiemeb" />
						<text  ng-if="bol" ng-class="updateColor(<?=htmlspecialchars($c0lumn); ?>,<?=htmlspecialchars($i+1); ?>,<?=htmlspecialchars($spe); ?>,2)" ng-repeat="z in names | filter: { c0lumn: '<?=htmlspecialchars($c0lumn); ?>', row: '<?=htmlspecialchars($i+1); ?>'}:true "  x="20%" y="<?=htmlspecialchars($height*60+30); ?>" class="default_text">{{ z.player_pseudo}}</text>
						</g>
						<?php
						if ($c0lumn < 6){
							if ($nbcases > 1){
								echo '<line class="troisiemea" x1="80%" y1="'.(60*$height+25).'" x2="85%" y2="'.(60*$height+25).'"   />';
								if ($i%2 == 0 && $nbcases != 3){
									echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+25).'" x2="85%" y2="'.(60*$height+85).'"   />';
									if ($c0lumn == 1){
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+55*$c0lumn).'" x2="100%" y2="'.(60*$height+55*$c0lumn).'"   />';	
									}
									if ($c0lumn == 2){
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+85).'" x2="85%" y2="'.(60*$height+145).'"   />';
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+40*$c0lumn).'" x2="100%" y2="'.(60*$height+40*$c0lumn).'"   />';
									}
									if ($c0lumn == 3 && $nbcases != 1){
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+85).'" x2="85%" y2="'.(60*$height+145).'"   />';
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+49*$c0lumn).'" x2="100%" y2="'.(60*$height+49*$c0lumn).'"   />';
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+145).'" x2="85%" y2="'.(60*$height+265).'"   />'; 
									}
									if ($c0lumn == 4 && $nbcases != 3){
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+85).'" x2="85%" y2="'.(60*$height+505).'"   />';
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+65*$c0lumn).'" x2="100%" y2="'.(60*$height+65*$c0lumn).'"   />';  
									}
									
									if ($c0lumn == 5 && $nbcases > 1){
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+85).'" x2="85%" y2="'.(60*$height+985).'"   />';
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+106.5*$c0lumn).'" x2="100%" y2="'.(60*$height+106.5*$c0lumn).'"   />';
									}
								}
								if ($c0lumn == 4 && $nbcases == 3){
									if ($i == 0){
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+25).'" x2="85%" y2="'.(60*$height+985).'"   />'; 
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+126.35*$c0lumn).'" x2="100%" y2="'.(60*$height+126.35*$c0lumn).'"   />';
									}
								}
								
							}	
						}
						$height += 1;

						if ($c0lumn > 1){
							$height += 1;
						}

						if ($c0lumn > 2){
							$height += $c0lumn - 1;
							
						}
						if ($c0lumn > 3){
							$height += $c0lumn / 1.33;
						}
						if ($c0lumn > 4){
							$height += $c0lumn * 1.25;
						}



	
						
					}
					if ($nbcases == 3){
					$nbcases = 1;
					}
					$nbcases /= 2;
					$height = 2**$centerize-0.5;
					if ($c0lumn >= 2){
						$height += $c0lumn*0.25;
						if ($c0lumn >= 3){
							$height += $c0lumn*0.40;
							if ($c0lumn >= 4 && $nbcases == 1){
								$height += $c0lumn * 0.615;
								if ($c0lumn >= 5){
									$height += $c0lumn * 1.2;
								}
							}
							else if ($c0lumn >= 4){
								if ($maxc0lumn == 5)
									$height += $c0lumn * 1.63;
								if ($maxc0lumn != 5)
									$height += $c0lumn * 0.615;
							}
						}
					}
					
					if ($c0lumn > 2)
					{
						$counter += 1;
					}
					$centerize += 0.5;
					
					echo '</svg>';
				}

	}
				





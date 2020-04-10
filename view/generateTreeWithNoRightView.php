
<DOCTYPE>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css"> 
		<link href="css/style_connectionUserView" rel="stylesheet" type="text/css">
	</head>
	<body>
	<?php include("view/header.php"); ?>
		
	
			<?php  generator($three_size,$donne,$three_name); ?>
			
			<?php include("view/footer.php"); ?>
	</body>
	
</html>

<?php


	function generator($three_size,$data,$three_name){
				
				$nbcases = $three_size; // SEULE VARIABLE A CHANGER POUR AVOIR DES ARBRES DIFFERENTS POUR 2,4,8,16,24 OU 32 JOUEURS
				$height = 0;
				$centerize = 0;
				$counter = 0;
				$maxc0lumn = 0;


					$i = 0;
				$arr = array();
				while (!empty($data[$i])){
					
					$arr[$data[$i]['c0lumn']][$data[$i]['row']]=$data[$i]['player_pseudo'];
					$i+=1;
				}
				
			

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


					echo '<svg height="2100" width="15%">';

					for ($i = 0 ; $i < $nbcases ; $i++){
							$color = "cinquiemeb";
							if(empty($arr[$c0lumn][$i+1]) ){
								$donne = "";
								
							}
							else{
								$donne = $arr[$c0lumn][$i+1];
							}
							//var_dump($arr);	
							$a=$i+1;
							$y=0;
							if($a%2==0){
								$temp = $a/2;
    							
  						  	}
    						else{
    							$temp=$a-floor($a/2);
    						}
								if(!empty($arr[$c0lumn+1][$temp]) )
								{

								if(strcmp($arr[$c0lumn][$a],$arr[($c0lumn+1)][$temp])==0){

								$color = "cinquiemec";
								}
							}
							
									
											


						?>


						<g ng-click="updatePosition(<?=htmlspecialchars($c0lumn); ?>,<?=htmlspecialchars($i+1); ?>)">
						<rect class="<?=htmlspecialchars($color); ?>"  x="0" y="<?=htmlspecialchars($height*60); ?>" width="80%" height="70"/>
						<text  class="default_text"  x="20%" y="<?=htmlspecialchars($height*60+30); ?>"><?=htmlspecialchars($donne); ?></text>
						</g>
						<?php
						if ($c0lumn < 6){
							if ($nbcases > 1){
								echo '<line class="troisiemea" x1="80%" y1="'.(60*$height+25).'" x2="85%" y2="'.(60*$height+25).'" />';
								if ($i%2 == 0 && $nbcases != 3){
									echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+25).'" x2="85%" y2="'.(60*$height+85).'"/>';
									if ($c0lumn == 1){
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+55*$c0lumn).'" x2="100%" y2="'.(60*$height+55*$c0lumn).'"/>';	
									}
									if ($c0lumn == 2){
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+85).'" x2="85%" y2="'.(60*$height+145).'"/>';
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+40*$c0lumn).'" x2="100%" y2="'.(60*$height+40*$c0lumn).'"/>';
									}
									if ($c0lumn == 3 && $nbcases != 1){
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+85).'" x2="85%" y2="'.(60*$height+145).'" />';
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+50*$c0lumn).'" x2="100%" y2="'.(60*$height+50*$c0lumn).'"/>';
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+145).'" x2="85%" y2="'.(60*$height+265).'"/>'; 
									}
									if ($c0lumn == 4 && $nbcases != 3){
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+85).'" x2="85%" y2="'.(60*$height+505).'"/>';
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+67.5*$c0lumn).'" x2="100%" y2="'.(60*$height+67.5*$c0lumn).'"/>';  
									}
									
									if ($c0lumn == 5 && $nbcases > 1){
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+85).'" x2="85%" y2="'.(60*$height+985).'"/>';
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+107.5*$c0lumn).'" x2="100%" y2="'.(60*$height+107.5*$c0lumn).'"/>';
									}
								}
								if ($c0lumn == 4 && $nbcases == 3){
									if ($i == 0){
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+25).'" x2="85%" y2="'.(60*$height+985).'"/>'; 
										echo '<line class="troisiemea" x1="85%" y1="'.(60*$height+126.35*$c0lumn).'" x2="100%" y2="'.(60*$height+126.35*$c0lumn).'" />';
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
									$height += $c0lumn * 1.6;
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
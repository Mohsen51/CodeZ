<DOCTYPE>
<html>
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<link href="css/style_connectionUserView" rel="stylesheet" type="text/css">
	<body>
		<?php include("view/header.php"); ?>
		<div id="bannerConnection">
			<body style="background-color:#181818;">
			<div id="TitreToken">
				<p style="color:#ffffff"> FIND A TREE </p>
			</div>
			<div id="connection">
				<form  method="POST"action="routeur.php?action=token" >
				Tree: <input type="text" name="token" style="color : #696969"> </br> </br>
				<input type="submit" style="margin-left : 60px">
				</form>
				<?=  htmlspecialchars($error); ?>
				<div>
					<canvas id="cup" width="250" height="250"
						style="background: url(view/images/cup.png) no-repeat center center;
						border:10px solid #181818;">
					</canvas>
				</div>
			</div>
			<?php include("view/footer.php"); ?>
		</div>
	</body>


</html>



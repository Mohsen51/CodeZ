<DOCTYPE>
<html>
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<link href="css/style_connectionUserView" rel="stylesheet" type="text/css">
	<body>
		<?php include("view/header.php"); ?>
		<div id="bannerConnection">
			<body style="background-color:#181818;">
			<div id="Titre">
				<p style="color:#ffffff"> LOG IN </p>
			</div>
			<div id="connection">
				<form  method="POST"action="routeur.php?action=connectionVerification" >
				<div id="pseudo">	
					Pseudo: <input type="text" name="pseudo" style="color:#696969"> </br>
				</div>
				Password: <input type="password" name="password" style="color:#696969"> </br>
				<input type="submit" style="margin-left: 117.5px">
				</form>
				<?=  htmlspecialchars($error); ?>

				<a href="routeur.php?action=inscription" style="color:#ffffff"> Sign In </a>
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
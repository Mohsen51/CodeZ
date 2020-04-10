<DOCTYPE>
<html>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>  
  <script src="Main.js"></script>
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <link href="css/style_connectionUserView" rel="stylesheet" type="text/css">
	<body>
    <div ng-app="myApp" ng-controller="customersCtrl">
    <?php include("view/header.php"); ?>
    <div id="banner">
      <body style="background-color:#181818;">
      <div id="TitreTrees"> 
  		  <h1> YOUR TREES</h1>
      </div>
     
		 <div style="overflow:scroll; width:100%; height:500; border:#181818 1px solid;padding-left : 30px;">
       <p ng-click="disp()" style="color : #ffffff">Click here to display shared codes</p>
		<?php 
		$i = 0;
		   while (!empty($data[$i]['three_name']) )
        {
        ?>
          <div id="usertree">
            <form  method="POST" action="routeur.php?action=displayTree">
              <button ><?=htmlspecialchars($data[$i]['three_name']); ?></button>
              <label ng-hide="custom"><?=htmlspecialchars($data[$i]['token']); ?></label>
              <input style="display:none;" type="text" name="three_size" class = "default_text" value ="<?=htmlspecialchars($data[$i]['three_size']); ?>"></input>
              <input style="display:none;" type="text" name="token" value ="<?=htmlspecialchars($data[$i]['token']); ?>"></input>
      		  </form>
          </div>



         <?php
           $i+=1;
        } 
        ?>
      </div>
    </div>
  <?php include("view/footer.php"); ?>
  </div>
	</body>
</html> 
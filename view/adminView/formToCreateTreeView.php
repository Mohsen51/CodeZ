<DOCTYPE>
<html>
<head>
	 <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>  
	 <meta charset="UTF-8">
	 <title>createFormTree</title>
	 <link href="css/style.css" rel="stylesheet" type="text/css">
	 <link href="css/style_connectionUserView" rel="stylesheet" type="text/css">
	 
	    
</head>
	<body>
		<?php include("view/header.php"); ?>
		<div id="banner">
			<div ng-app="myApp" ng-controller="customersCtrl" >
				<body style="background-color:#181818;">
				<div id="TitreToken">
					<p style="color:#ffffff"> CREATE A TREE </p>
				</div>
				<div id="connection">
					<form>
						<label style="color:#ffffff">Select a size:</label>
						<select ng-model="size">
							<br>
							<option value="2">2
							<option value="4">4
							<option value="8">8
							<option value="16">16
							<option value="24">24
							<option value="32">32
						</select>
					</form>
					<div style="overflow:scroll; width:100%; height:500; border:#181818 1px solid;">
						<form  method="POST" action="routeur.php?action=createTree" >
							<label style = "color:#ffffff">tree name: <input type="text" name="tree_name"> </label>
							<div ng-switch="size">
							  	<div id = "when2"ng-switch-when="2">
									<label ng-repeat="n in range(1,2)">Player {{n}} <input type="text" name="{{n}}"><br></label>
								</div>
								<div ng-switch-when="4">
									<label ng-repeat="n in range(1,4)">Player {{n}} <input type="text" name="{{n}}"><br></label>
								</div>
								<div ng-switch-when="8">
									<label ng-repeat="n in range(1,8)">Player {{n}} <input type="text" name="{{n}}"><br></label>
								</div>
								<div ng-switch-when="16">
									<label ng-repeat="n in range(1,16)">Player {{n}} <input type="text" name="{{n}}"><br></label>
								</div>
								<div ng-switch-when="24">
									<label ng-repeat="n in range(1,24)">Player {{n}} <input type="text" name="{{n}}"><br></label>
								</div>
								<div ng-switch-when="32">
									<label ng-repeat="n in range(1,32)">Player {{n}} <input type="text" name="{{n}}"><br></label>
								</div>
								<button type="submit" style="margin-left : 119px">Submit</button>			
							</div>
						</form>
					</div>
					<?php echo $error; ?>
				</div>
			</div>
			<div>
				<canvas id="cup2" width="250" height="250"
						style="background: url(view/images/cup.png) no-repeat center center;
						border:10px solid #181818;">
				</canvas>
			</div>
		</div>
		<?php include("view/footer.php"); ?>
	</body>
</html>

<script>
var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {

	  $scope.range = function(min, max, step) {
	        step = step || 1;
	        var input = [];
	        for (var i = min; i <= max; i += step) {
	            input.push(i);
	        }
	        return input;
	    };
	   
	});

	

</script>



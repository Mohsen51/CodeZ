<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>  
<script src="Main.js"></script>
<link href="css/style_header.css" rel="stylesheet" type="text/css">
<header>
    <a href="routeur.php?action=backToFirstPage"><h1 class="logo"> CODE ZZ </h1>
        <a ng-click="disp()" class="burger-nav"></a>
            <nav>
                <ul>
                    <li><a href="routeur.php?action=findTree"><h2>Search a tree</h2></a></li>
                    <li><a href="routeur.php?action=formToCreateTree"><h2>Create a tree</h2></a></li>
                    <?php if((empty($_SESSION['owner_id']))){
                        echo '<li><a href="routeur.php?action=connection"><h2>Log in</h2></a></li>';
                            echo '<li><a href="routeur.php?action=inscription"><h2>Sign in</h2></a></li>';
                    }
                    else{ 
                        echo '<li><a href="routeur.php?action=deconnection"><h2>Log out</h2></a></li>';
                        echo '<li><a href="routeur.php?action=displayUserTree"><h2>My Trees</h2></a></li>';
                        } ?>
                    
                </ul>
            </nav>
</header>




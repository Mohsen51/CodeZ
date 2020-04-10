<!DOCTYPE html>
    <html>
    <head>
        <title>CODE ZZ</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
    </head>
    <body>
        <div ng-app="myApp" ng-controller="customersCtrl" >
        <?php include("view/header.php"); ?>
        <div id="banner" class="bannerclass">
            <img src="view/images/arriere.png" alt="banner">
            <section id="textbanner">
                <section id="titre">
                    <ul>
                        <li>
                            <h1>The best way to manage your tournaments</h1>
                        </li>
                        <li>
                            <img src="view/images/codezz.png" alt="CODE ZZ">
                        </li>
                    </ul>
                </section>
                <section id ="boutons">
                    <a href="routeur.php?action=formToCreateTree"><img src="view/images/creer.png" alt="Create a tree"></a>
                    <a href="routeur.php?action=findTree"><img src="view/images/retrouver.png" alt="Search a tree"></a>
                </section>
            </section>
        </div>
        <?php include("view/footer.php"); ?>
    </div>
    </body>
</html>
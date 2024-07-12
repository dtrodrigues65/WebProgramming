<?php
ini_set("session.save_path", "/home/unn_w21032322/sessionData");
session_start();

	require_once('functions.php');
    if (check_login()) {
        $login = true;
    } else {
        $login =false;
    }
	echo makePageStart("NTL Toys", "review.css");
    echo makeHeader("Homepage");
    if ($login) {
        echo makeNavMenuOnline("Categories", array("homepage.php" => "Home", "listToys.php" => "See and edit Toys", "orderToysForm.php" => "Order Toys", "credits.php" => "Credits" ));
    } else {
        echo makeNavMenu("Categories", array("homepage.php" => "Home", "orderToysForm.php" => "Order Toys", "credits.php" => "Credits" ));
    }
    echo startmain();
?>
    <aside id = "offers">
        Offers
    </aside>
<?php
    echo "<script type='text/javascript' src='homepage.js'></script>";
    echo endMain();
    echo makeFooter("Diogo Rodrigues productions");
    echo makePageEnd();
?>

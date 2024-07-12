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
    echo makeHeader("Credits");
    if ($login) {
        echo makeNavMenuOnline("Categories", array("homepage.php" => "Home", "listToys.php" => "See and edit Toys", "orderToysForm.php" => "Order Toys", "credits.php" => "Credits" ));
    } else {
        echo makeNavMenu("Categories", array("homepage.php" => "Home", "orderToysForm.php" => "Order Toys", "credits.php" => "Credits" ));
    }
    echo startmain();
?>
<h1>Name: Diogo Rodrigues</h1>
<h2>Student 21032322</h2>
<small>
    Northumbria University
</small>

<h3>Sources<h3>
<ul>
  <li>W3schools.com. 2022. HTML Tables. [online] Available at: <a href = "https://www.w3schools.com/html/html_tables.asp">link</a> [Accessed 5 January 2022].</li>
  <li>Adapted classes' material from Web Programming </li>
  <li>W3schools.com. 2022. HTML Lists. [online] Available at: <a href ="https://www.w3schools.com/html/html_lists.asp">link</a> [Accessed 4 January 2022].</li>
</ul> 


<?php
    echo endMain();
    echo makeFooter("Diogo Rodrigues productions");
    echo makePageEnd();
?>

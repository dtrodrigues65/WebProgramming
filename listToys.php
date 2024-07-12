<?php
ini_set("session.save_path", "/home/unn_w21032322/sessionData");
session_start();

    require_once('functions.php');
    if (check_login()) {
        $login = true;
    } else {
        header("Location: homepage.php");
    }
	echo makePageStart("NTL Toys", "review.css");
    echo makeHeader("Edit Toys");
    echo makeNavMenuOnline("Categories", array("homepage.php" => "Home", "listToys.php" => "See and edit Toys", "orderToysForm.php" => "Order Toys", "credits.php" => "Credits" ));
    echo startmain();
        try {
            require_once("functions.php");
            $dbConn = getConnection();

            $sqlQuery = "SELECT  toyID, toyName, description, toyPrice, catDesc
		    FROM NTL_toys
		    INNER JOIN NTL_category
		    ON NTL_toys.catID = NTL_category.catID
		    ORDER BY toyName";

            $queryResult = $dbConn->query($sqlQuery);

            
            echo "<table>\n
            <tr>\n
            <th>Toy Name</th>\n
            <th>Description</th>\n
            <th>ToyPrice</th>\n
            <th>Category</th>\n
            </tr>\n";
            while ($rowObj = $queryResult->fetchObject()) {
                echo "<tr><div class='Toy'>\n
                <td><span class='toyName'><a href='editToysForm.php?toyID=$rowObj->toyID'>$rowObj->toyName</a></span></td>\n
                <td><span class='description'>{$rowObj->description}</span></td>\n
                <td><span class='toyPrice'>{$rowObj->toyPrice}</span></td>\n
                <td><span class='catDesc'>{$rowObj->catDesc}</span></td>\n
                </div></tr>\n";
            }
            echo "</table>";
        }
        catch (Exception $e) {
            echo "Error " . $e->getMessage();
        }
    echo endMain();
    echo makeFooter("Diogo Rodrigues productions");
    echo makePageEnd();
?>

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
    echo makeHeader("Update Toy");
    echo makeNavMenuOnline("Categories", array("homepage.php" => "Home", "listToys.php" => "See and edit Toys", "orderToysForm.php" => "Order Toys", "credits.php" => "Credits" ));
    echo startmain();

        $toyID = filter_has_var(INPUT_GET, 'toyID')? $_GET['toyID'] : null;
        $toyName = filter_has_var(INPUT_GET, 'toyName')? $_GET['toyName'] : null;
        $description = filter_has_var(INPUT_GET, 'description')? $_GET['description'] : null;
        $manID = filter_has_var(INPUT_GET, 'manu')? $_GET['manu'] : null;
        $catID = filter_has_var(INPUT_GET, 'category')? $_GET['category'] : null;
        $toyPrice = filter_has_var(INPUT_GET, 'price')? $_GET['price'] : null;
        trim($toyID);
        trim($toyName);
        trim($manID);
        trim($catID);
        trim($toyPrice);
        trim($description);
        
       if (empty($toyName)) {
            echo "<h1>You have not entered a toy name</h1>\n";
        } else if (empty($description)) {
            echo "<h1>You have not entered a description</h1>\n";
        }else if (empty($manID)) {
            echo "<h1>You have not entered a manufacter</h1>\n";
        }else if (empty($catID)) {
            echo "<h1>You have not entered a category</h1>\n";
        }else if (empty($toyPrice)) {
            echo "<h1>You have not entered a price</h1>\n";
        }else if (!is_numeric($toyPrice)) {
            echo "<h1>The toy price got to be a number</h1>\n";
        } else {
            try {
                require_once("functions.php");
                $dbConn = getConnection();

                $updateSQL = "UPDATE NTL_toys SET
                toyName = :toyName, 
                description = :description, 
                manID = :manID, 
                catID = :catID, 
                toyPrice = :toyPrice
                WHERE toyID = :toyID";
                
                $stmt = $dbConn->prepare($updateSQL); 
                $stmt->execute(array(':toyName' => $toyName, 
               ':description' => $description, 
                ':manID' => $manID,
                ':catID' => $catID,
                ':toyPrice' => $toyPrice,
                ':toyID' => $toyID));

                echo "<h1> The toy $toyName was updated with sucess</h1>\n";
                
            } catch (Exception $e) {
                echo "<p>Toy not updated: " . $e->getMessage() . "</p>\n";
           }
            
        }
    echo endMain();
    echo makeFooter("Diogo Rodrigues Productions");
    echo makePageEnd();
    ?>
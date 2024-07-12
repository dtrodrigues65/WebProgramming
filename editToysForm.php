<?php
ini_set("session.save_path", "/home/unn_w21032322/sessionData");
session_start();


    require_once('functions.php');
    if (check_login()) {
        $login = true;
    } else {
        header("Location: homepage.php");
    }
    echo makePageStart("NTL toys", "review.css");
    echo makeHeader("Edit toys");
    echo makeNavMenuOnline("Categories", array("homepage.php" => "Home", "listToys.php" => "See and edit Toys", "orderToysForm.php" => "Order Toys", "credits.php" => "Credits" ));
    echo startmain();

        $toyID = $_GET['toyID'];
        if (empty($toyID)) {
            header("Location: listToys.php");
        } else {
            try {
                require_once("functions.php");
                $dbConn = getConnection();

                $sqlQuery = "SELECT toyID, toyName, description , manID ,catID, toyPrice
                FROM NTL_toys
                WHERE toyID = $toyID";

                $queryResult = $dbConn->query($sqlQuery);

                $rowObj = $queryResult->fetchObject();

                $sqlCat = "SELECT catID, catDesc from NTL_category ORDER BY catDesc";
                $rsCat = $dbConn->query($sqlCat);

                $sqlMan = "SELECT manID, manName from NTL_manufacturer ORDER BY manName";
                $rsMan = $dbConn->query($sqlMan);

                echo "<form id='updateToy' action='updateToy.php' method='get'>
                <h2> Edit a toy </h2>
                <p>Toy ID<input type='text' name='toyID' value='{$rowObj->toyID}' readonly></p>
                <p>Toy Name<input type='text' name='toyName' value='{$rowObj->toyName}'></p>
                <p>Description<input type='text' name='description' value='{$rowObj->description}'></p>
                <p>Manufacter<select name='manu'>";
                
                while ($manRecord = $rsMan->fetchObject()) {
                    if ($rowObj->manID == $manRecord->manID) {
                        echo "<option value='{$manRecord->manID}' selected>
                        {$manRecord->manName}</option>";
                    }
                    else { 
                        echo "<option value='{$manRecord->manID}'>{$manRecord->manName}</option>";
                    }
                    
                }
                
                echo "</select></p>
                    <p>Category<select name='category'>";

                while ($catRecord = $rsCat->fetchObject()) {
                    if ($rowObj->catID == $catRecord->catID) {
                        echo "<option value='{$catRecord->catID}' selected>
                        {$catRecord->catDesc}</option>";
                    }
                    else { 
                        echo "<option value='{$catRecord->catID}'>{$catRecord->catDesc}</option>";
                    }
                    
                }

                echo " </select></p>
                <p>Price<input type='text' name='price' value='{$rowObj->toyPrice}'></p>
                <input type='submit' value='Update'>
                </form>";

            }catch (Exception $e) {
                echo "Error " . $e->getMessage();
            }
            
        }
        echo endMain();
        echo makeFooter("Diogo Rodrigues Productions");
        echo makePageEnd();
    ?>
    
<?php
    function getConnection () {
        try {
            $connection = new PDO ("mysql:host=localhost;dbname=unn_w21032322", "unn_w21032322", "@Oxford12");
            return $connection;
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            throw new Exception("Connection error ".$e->getMessage(), 0, $e);

        }
    }

    function set_session($key, $value) {
        // Set key element = value
        $_SESSION[$key] = $value;
        return true;
     }

     function get_session($key) {
        // Set key element = value
        $return = "nothing";
        if (isset($_SESSION[$key])) {		
            $return = $_SESSION[$key];			
        }
        return $return;
     }

     function check_login () {
        if (isset($_SESSION['logged-in'])) {		
            return true;
        }
        return false;
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////
    function makePageStart($title, $ref) {
        $pageStartContent = <<<PAGESTART
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>$title</title> 
            <link href=$ref rel="stylesheet" type="text/css">
        </head>
        <body>
        <div id="gridContainer">
PAGESTART;
        $pageStartContent .="\n";
        return $pageStartContent;
    }

    function makeHeader($headerText){
        $headContent = <<<HEAD
            <header>
                <h1>$headerText</h1>
            </header>
HEAD;
        $headContent .="\n";
        return $headContent;
    }

    function makeNavMenu($navMenuHeader, array $links) {
        $output = "";
        foreach ($links as $k => $v) {
            $output .= "<li><a href=$k>$v</a></li>";
        }
        $navMenuContent = <<<NAVMENU
            <nav>
                <h2>$navMenuHeader</h2>
                <ul>
                    $output
                </ul>
                <form id ="login" method="post" action="loginProcess.php">
                <p>Username <input type="text" name="username"></p>
                <p>Password <input type="password" name="password"></p>
                <input type="submit" value="Logon">
                </form>	
            </nav>  
NAVMENU;
        $navMenuContent .= "\n";
        return $navMenuContent;
    }

    function makeNavMenuOnline($navMenuHeader, array $links) {
        $output = "";
        foreach ($links as $k => $v) {
            $output .= "<li><a href=$k>$v</a></li>";
        }
        $navMenuContent = <<<NAVMENU
            <nav>
                <h2>$navMenuHeader</h2>
                <ul>
                    $output
                </ul>
                <form id ="logout" method="post" action="logout.php">
                <input type="submit" value="Logout">
                </form>
            </nav>  
NAVMENU;
        $navMenuContent .= "\n";
        return $navMenuContent;
    }

    function startMain() {
        return "<main>\n";
    }

    function endMain() {
        return "</main>\n";
    }

    function makeFooter($footerText) {
        $footContent = <<<FOOT
        <footer>
        <p>$footerText</p>
        </footer>
FOOT;
            $footContent .="\n";
        return $footContent;
    }

    function makePageEnd() {
        return "</div>\n</body>\n</html>";
    }

?>
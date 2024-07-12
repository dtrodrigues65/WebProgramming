<?php
ini_set("session.save_path", "/home/unn_w21032322/sessionData");
session_start();

list($input, $errors) = validate_logon();
if ($errors) {
     header("Location: homepage.php");
} 
else {
    set_session('logged-in', 'true');
    header("Location: homepage.php");
}

    function validate_logon () {
        $input = array();
        $errors = array();
        
        $input ['username'] =filter_has_var(INPUT_POST, 'username') ? $_POST['username']: null;
        $input ['password'] =filter_has_var(INPUT_POST, 'password') ? $_POST['password']: null;

        $input['username'] = trim($input['username']);
        $input['password'] = trim($input['password']);

        if (empty($input ['username'])) {
            $errors [] = "<p>Username is empty</p>\n";
        }

        try {
            require_once("functions.php");
            $dbConn = getConnection();

            
            $querySQL = "SELECT passwordHash FROM NTL_users 
            WHERE username = :username";
        
            $stmt = $dbConn->prepare($querySQL);
        
            $stmt->execute(array(':username' => $input['username']));

            $user = $stmt->fetchObject();
            if ($user) {
                $passwordHash = $user->passwordHash;
                if (password_verify($input['password'], $passwordHash)) {
                    $_SESSION['logged-in'] = true;
                } else {
                    $errors [] = "<p>Password or username are incorrect. Try again</p>\n";
                }
            }
            else {
                $errors [] = "<p>Password or username are incorrect. Try again</p>\n";
            }
        }catch (Exception $e) {
            echo "Error " . $e->getMessage();
        }
        return array ($input, $errors);
    } 
?>
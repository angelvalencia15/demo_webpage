#!/usr/local/bin/php
<?php
	header('Content-Type: text/plain; charset=utf-8');

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // get data from POST request
        $username = $_POST['username'];
        $credit = $_POST['credit'];

        //make sure data exists
        if (empty($username) || empty($credit)) {
            echo "Either the user or credit was not posted.";
            exit;
        }

        $db = new SQLite3('credit.db');

        $update_statement = "UPDATE users SET credit = $credit WHERE username = '$username'";
        $db->exec($update_statement);
        $db->close();
        //echo "Credit Updated Successfully.";
    } else {
        echo "Either the user or credit was not posted.";
    }
?>
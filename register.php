<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //validate submission
        if(empty($_POST["username"]))
        {
            apologize("Please enter username.");
        }
        elseif(empty($_POST["password"]))
        {
            apologize("Please enter password");
        }
        elseif(empty($_POST["confirmation"]))
        {
            apologize("Please confirm your password.");
        }
        elseif(($_POST["password"])!= ($_POST["confirmation"]))
        {
            apologize("Your password does not match. Try again!");
        }
        
        //insert new user into database
        if((CS50::query("INSERT IGNORE INTO users (username, hash, cash) VALUES(?,?,10000.0000)",$_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT))) == 0)
        {
            apologize("Username already exsits.");
        }
        
        
        
        //find the last-insert-user ID
        $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
        
        //assign last-insert-d into variable $id
        $id = $rows[0]["id"];
        
        //remember this user by storing user's ID in session
        $_SESSION["id"] = $id;
        
        //redirect to portfolio
        redirect("/");
    }

?>
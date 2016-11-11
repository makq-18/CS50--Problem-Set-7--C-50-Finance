<?php

    // configuration
    require("../includes/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("funds_before.php", ["title" => "Funds"]);
    }
    
    elseif($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["amount"]))
        {
            apologize("Please enter the amount.");
        }
        elseif(($_POST["amount"] > 20000) || ($_POST["amount"] < 1))
        {
            apologize("Please enter amount between 1 and 500 only.");
        }
        
        elseif(preg_match("/^\d+$/", $_POST["amount"]) != true)
        {
            apologize("Please enter correct amount.");
        }
        
        //run a query and extract all the values of user into local associative arrays.
        
        $id = $_SESSION["id"];
        
        $amount = $_POST["amount"];
        
        $users = CS50::query("SELECT cash FROM users WHERE id = ?", $id);
        
        foreach($users as $user)
        {
            $cash = $user["cash"];
        }
        
        if($cash > 20000)
        {
            apologize("You already have sufficient funds.");
        }
        
        CS50::query("UPDATE users SET cash = cash + '$amount' WHERE id = $id");
        
        $show_users = CS50::query("SELECT cash FROM users WHERE id = '$id'");

        render("funds_after.php", ["show_users" => $show_users, "title" => "Funds"]);
    }

?>
<?php

    // configuration
    require("../includes/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("buy_before.php", ["title" => "Buy"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["symbol"]))
        {
            apologize("Please enter the symbol.");
        }
        elseif(empty($_POST["quantity"]))
        {
            apologize("Please enter the quantity.");
        }
        
        elseif((lookup($_POST["symbol"])) == false)
        {
            apologize("Please enter valid symbol.");
        }
        
        elseif(preg_match("/^\d+$/", $_POST["quantity"]) != true)
        {
            apologize("Please enter correct quantity.");
        }
        
        //run a query and extract all the values of user into local associative arrays.
        
        $id = $_SESSION["id"];
        
        $quantity = $_POST["quantity"];
        
        $symbol = strtoupper($_POST["symbol"]);
        
        $buy_stock = lookup($symbol);
        
        $amount = 0;
        
        $shares = 0;
        
        $users = CS50::query("SELECT * FROM users WHERE id = ?", $id);
        
        $portfolios = CS50::query("SELECT * FROM portfolio WHERE user_id = ? AND symbol = ?", $id, $symbol);
        
        foreach($users as $user)
        {
            $user_info[] = [
                "cash" => $user["cash"]
                ];
        }
        
        foreach($portfolios as $portfolio)
        {
                $shares = $portfolio["shares"];
        } 
        
        $amount = $quantity * $buy_stock["price"];
        
        if($amount > $user["cash"])
        {
            apologize("Insufficient Funds.");
        }
        
        CS50::query("INSERT INTO portfolio (user_id, symbol, shares) VALUES(?,?,?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $id, $symbol, $quantity);
        
        CS50::query("UPDATE users SET cash = cash - '$amount' WHERE id = $id");
        
        CS50::query("INSERT INTO history (user_id, type, symbol, shares, price) VALUES (?, 'BUY', ?, ?, ?)", $id, $symbol, $quantity, $buy_stock["price"]);
        
        $show_users = CS50::query("SELECT * FROM users WHERE id = '$id'");
        
        $show_portfolios = CS50::query("SELECT * FROM portfolio WHERE user_id = ? AND symbol = ?", $id, $symbol);

        render("buy_after.php", ["buy_stock" => $buy_stock, "show_users" => $show_users, "show_portfolios" => $show_portfolios, "title" => "Buy"]);
        
        
    }
    else
    {
        apologize("Invalid!!");
    }

?>
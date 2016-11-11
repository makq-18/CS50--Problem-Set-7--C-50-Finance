<?php

    // configuration
    require("../includes/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("sell_before.php", ["title" => "Sell"]);
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
        
        //run a query and extract all the values of user into local associative arrays.
        
        $id = $_SESSION["id"];
        
        $quantity = $_POST["quantity"];
        
        $sell_stock = lookup($_POST["symbol"]);
        
        $symbol = strtoupper($_POST["symbol"]);
        
        $amount = 0;
        
        $shares = 0;
        
        $users = CS50::query("SELECT * FROM users WHERE id = ?", $id);
        
        $portfolios = CS50::query("SELECT * FROM portfolio WHERE user_id = ? AND symbol = ?", $id, $symbol);
        
        foreach($portfolios as $portfolio)
        {
                $shares = $portfolio["shares"];
        }
        
        if($quantity < $shares)
        {
            CS50::query("UPDATE portfolio SET shares = shares - '$quantity' WHERE user_id = '$id' AND symbol = '$symbol'");
            
            $amount = $sell_stock["price"] * $quantity;
            
            CS50::query("UPDATE users SET cash = cash + $amount WHERE id = $id");
            
        }
        
        elseif($quantity > $shares)
        {
            apologize("Please enter valid quantity.");
        }
        
        elseif($quantity == $shares)
        {
            CS50::query("DELETE FROM portfolio WHERE user_id = $id AND symbol = $symbol");
            
            $amount = $sell_stock["price"] * $quantity;
            
            CS50::query("UPDATE users SET cash = cash + $amount WHERE id = $id");
        }
        
        CS50::query("INSERT INTO history (user_id, type, symbol, shares, price) VALUES (?, 'SELL', ?, ?, ?)", $id, $symbol, $quantity, $sell_stock["price"]);
        
        $show_users = CS50::query("SELECT * FROM users WHERE id = '$id'");
        
        $show_portfolios = CS50::query("SELECT * FROM portfolio WHERE user_id = ? AND symbol = ?", $id, $symbol);

        render("sell_after.php", ["sell_stock" => $sell_stock, "show_users" => $show_users, "show_portfolios" => $show_portfolios, "title" => "Sold"]);
    }
    else
    {
        apologize("Invalid!!");
    }

?>
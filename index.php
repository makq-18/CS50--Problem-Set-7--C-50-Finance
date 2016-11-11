<?php

    // configuration 
    require("../includes/config.php"); 

    $rows = CS50::query("SELECT * FROM portfolio WHERE user_id = ?", $_SESSION["id"]);
 
    $positions = [];
    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"]
            ];
        }
    }
    
    $rows1 = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
    
    $moneys = [];
    
    foreach($rows1 as $row1)
    {
        $moneys[] = [
            "cash" => $row1["cash"]
            ];
    }
    
    
    
    // render portfolio
    render("portfolio.php", ["positions" => $positions, "moneys" => $moneys, "title" => "Portfolio"]);
?>
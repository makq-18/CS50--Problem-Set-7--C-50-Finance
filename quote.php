<?php

    // configuration
    require("../includes/config.php"); 
    
    $new = [];
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("symbol_submit.php", ["title" => "Quote"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["symbol"]))
        {
            apologize("You enter the symbol.");
        }
        elseif((lookup(strtoupper($_POST["symbol"]))) == false)
        {
            apologize("Please enter valid symbol.");
        }
        else
        {
            $stock = lookup($_POST["symbol"]);
        
            render("display.php", ["stock" => $stock, "title" => "Result"]);
        }
        
    } 
    
    else
    {
        apologize("Invalid!!");
    }

?>
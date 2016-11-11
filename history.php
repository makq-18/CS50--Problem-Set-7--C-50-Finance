<?php
    // configuration
    require("../includes/config.php"); 
    
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
         $id = $_SESSION["id"];
        
        $big_data = CS50::query("SELECT * FROM history WHERE user_id = ?", $id);

        render("history_view.php", ["big_data" => $big_data, "title" => "History"]);
        
    }
    
?>
    
    
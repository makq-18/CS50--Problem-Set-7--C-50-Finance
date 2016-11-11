<div>
    <?php
        foreach($show_users as $show_user)
        {
            $display_user[] = [
                "cash" => $show_user["cash"]
                ];
        }
        
        foreach($show_portfolios as $show_portfolio)
        {
            $display_portfolio[] = [
                "symbol" => $show_portfolio["symbol"],
                "shares" => $show_portfolio["shares"]
                ];
        }
    
    ?>
   <h3>Share:<?= $show_portfolio["symbol"] ?></h3>
   <h3>Name:<?= $sell_stock["name"] ?></h3>
   <h3>Current price:<?= $sell_stock["price"] ?></h3>
   <h3>Account balance:<?= $show_user["cash"] ?></h3>
   <h3>Quantity:<?= $show_portfolio["shares"] ?></h3>
</div>
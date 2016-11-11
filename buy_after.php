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
   <h5>Share:<?= $show_portfolio["symbol"] ?></h5>
   <h5>Name:<?= $buy_stock["name"] ?></h5>
   <h5>Current price:<?= $buy_stock["price"] ?></h5>
   <h5>Account balance:<?= $show_user["cash"] ?></h5>
   <h5>Quantity:<?= $show_portfolio["shares"] ?></h5>
</div>
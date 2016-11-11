
<div id="portfolio">
<table class="table table-striped" border = "1">

    <thead>
        <tr>
            <th>Symbol</th>
            <th>Name</th>
            <th>Shares</th>
            <th>Price</th>
            <th>TOTAL</th>
        </tr>
    </thead>

    <tbody align="left">
        <?php 
        foreach($positions as $position)
        {
            print("<tr>");
            print("<td>{$position["symbol"]}</td>");
            print("<td>{$position["name"]}</td>");
            print("<td>{$position["shares"]}</td>");
            print("<td>{$position["price"]}00</td>");
            $total = $position["shares"] * $position["price"];
            print("<td>\${$total}000</td>");
            print("</tr>");
        }
        ?>
    </tbody>

</table>
    </div>
<div>
<table class="table table-striped" border = "1">
    <thead>
        <tr>
            <th>Type</th>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Price</th>
            <th>Total</th>
            <th>Date n Time</th>
        </tr>
    </thead>

    <tbody align="left">
        <?php 
        foreach($big_data as $showme)
        {
            print("<tr>");
            print("<td>{$showme["type"]}</td>");
            print("<td>{$showme["symbol"]}</td>"); 
            print("<td>{$showme["shares"]}.00</td>");
            print("<td>\${$showme["price"]}.0000</td>");
            $total = $showme["shares"] * $showme["price"];
            print("<td>\${$total}.0000</td>");
            print("<td>{$showme["datentime"]}</td>");
            print("</tr>");
        }
        ?>
    </tbody>

</table>
</div>
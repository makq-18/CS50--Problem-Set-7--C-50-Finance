<div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Symbol</th>
            <th>Price</th>
        </tr>
    </thead>
    
      <tbody>
            <tr>
               <td><?= $stock["name"] ?></td>
               <td><?= $stock["symbol"] ?></td>
               <td>$<?= $stock["price"] ?>.00</td>
            </tr>
    </tbody>

</table>
    </div>

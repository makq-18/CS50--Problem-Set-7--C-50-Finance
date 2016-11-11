<div>
    <?php foreach($show_users as $show_user): ?>
   <h4>Your current account balance is: $<?= $show_user["cash"] ?></h4>
   <?php endforeach ?>
</div>
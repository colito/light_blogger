<?php
   $page_name = 'Home';
   require_once('includes/header.php');
?>

<!--
<div id="content" class="grid_12">
    <h3>Welcome!</h3>
    <p>This is a little demo project to play around with some light weight blogging.</p>
</div>
-->

<div id="blogs" class="prefix_4 grid_4">
    <?php $blogger->show_all_blogs(); ?>
</div>

<?php require_once('includes/footer.php'); ?>


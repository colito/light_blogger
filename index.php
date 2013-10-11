<?php
   require_once('fns/runner2.php');
   $blogger = new blogger();

   $page_name = 'Home';
   require_once('includes/head.php');
?>

<div class="container">
		
   <div id="header"class="grid_8">
        <h2>Main Page</h2>
   </div>

   <?php require_once('includes/links.php'); ?>

   <div id="content" class="grid_8">
       <h3>Welcome!</h3>
       <p>This is a little demo project to play around with some light weight blogging.</p>
   </div>

   <div id="blogs" class="grid_12">
       <?php $blogger->show_all_blogs(); ?>
   </div>

</div>

<?php require_once('includes/footer.php'); ?>


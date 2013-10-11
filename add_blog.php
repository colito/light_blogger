<?php
require_once('fns/runner2.php');
$blogger = new blogger();

$page_name = 'Add Blog';
require_once('includes/head.php');
?>

<div class="container">

	<div id="header" class="grid_8">
		<h2>Add</h2>
	</div>

    <?php require_once('includes/links.php'); ?>

	<div class="grid_5">
		<form method="post" action="blog_verifier.php">
			<!--
            <?php
			if(isset($_GET['feedback']))
			{
			    echo "<strong style='color:blue;>" . $_GET['feedback'] . "</strong>";
			}
			?>
			<br/><br/>
			-->

            <input type="text" name="blog_title" placeholder="Title">
            <br/><br/>

            <textarea name="blog_text"></textarea>

			<br/><br/>
    		<input type="submit">
		</form>
	</div>
</div>
<?php require_once('includes/footer.php'); ?>
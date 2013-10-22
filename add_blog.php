<?php
    $page_name = 'Add Blog';
    require_once('includes/header.php');
?>

<div id="content" class="grid_12">
	<h3>Add</h3>
    <p>This is where you can enter your blog content.</p>
</div>

<div id="content" class="prefix_3 grid_9">

	<form method="post" action="blog_verifier.php">
		<!--
        <?php
    		if(!empty($_GET['feedback']))
			{
			    echo "<strong style='color:blue;>" . $_GET['feedback'] . "</strong>";
			}
		?>
			<br/><br/>
		-->

        <input type="text" name="blog_title" placeholder="Title">
        <br><br>

        <textarea name="blog_text"></textarea>

	    <br>
        <input type="submit">
	</form>

</div>

<?php require_once('includes/footer.php'); ?>
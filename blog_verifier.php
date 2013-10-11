<?php
ob_start();
	require_once('fns/runner2.php');
	
	$blogger = new blogger();
	
	/* Blog Validation */
	if(isset($_POST['blog_text']))
	{
		$blog_text = "" . $_POST['blog_text'] . "";

		if(empty($blog_text))
		{
			$feedback = "Please enter some text for your post";
		}
		else
		{
			$save_blog = $blogger->insert_blog(2, $blog_text);
			
			if($save_blog == 'true')
			{
				$feedback = "Blog saved";
			}
			else
			{
				$feedback = "An error occured. Blog not saved.";
			}
		}
	}
	else
	{
		$feedback = "Please enter some text for your post.";
	}
	
	$feedback = urlencode($feedback);
	header('Location: add_blog.php?feedback='.$feedback);
ob_flush();
?>
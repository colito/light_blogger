<?php
ob_start();
	require_once('fns/runner2.php');
	
	$blogger = new blogger();
	
	/* Blog Validation */
	if(!empty($_POST['blog_text']))
	{
		$blog_text = "" . $_POST['blog_text'] . "";
        $blog_title = "" . $_POST['blog_title'] . "";

		if(empty($blog_title))
		{
			$feedback = "Please a blog title for your post";
		}
		else
		{
			$save_blog = $blogger->insert_blog(2, $blog_text, $blog_title);
			
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
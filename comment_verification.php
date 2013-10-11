<?php
	/* Comment Validation */
	if(isset($_POST['comment_text']))	
	{
		$blog_text = $_POST['comment_text'];
		if(empty($comment_text))
		{
			$feedback = "Please enter some text for your post";
		}
		else
		{	
			$save_comment = $blogger->insert_comment(1, $comment_text);
			
			if($save_comment == 'true')
			{
				$feedback = "Comment saved";
			}
			else
			{
				$feedback = "An error occured. Comment not saved.";
			}
		}
	}
	else
	{
		$feedback = "Please enter some text for your post.";
	}
	
	$feedback = urlencode($feedback);
	header('Location: add_comment.php?feedback='.$feedback);
?>
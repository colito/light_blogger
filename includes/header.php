<?php
    require_once('fns/runner2.php');
    $blogger = new blogger();
?>

<!DOCTYPE HTML>
<html lang="en">

<head lang="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $page_name ?></title>
    <link rel="stylesheet" href="css/normalize.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/grid.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />

    <!-- Place inside the <head> of your HTML -->
    <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea"
        });
    </script>
</head>

<div id="topper">

    <div id="title">
        <a href="index.php"><h2>The Light Blogger</h2></a>
    </div>

    <div id="links" class="animated">
        <a href="#">Log in</a> | <a href="register.php">Sign up</a>
    </div>

    <div id="links">
        <a href="index.php">Home</a> &nbsp;
        <a href="add_blog.php">Add</a> &nbsp;
    </div>

</div>

<body>
    <div class="container_12">
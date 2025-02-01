#!/usr/local/bin/php
<?php 
	header('Content-Type: text/plain; charset=utf-8');

	$postsFile = 'posts.txt';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
		// Grab author and content and send it all together to posts.txt
		$author = $_POST['author'];
		$content = $_POST['content'];
		$newPost = "<b>$author</b> says: $content \n";

		$file = fopen($postsFile, 'a');
		if ($file) {
			fwrite($file, $newPost);
			fclose($file);
			echo 'Post successfully written.';
		} 
		exit();	

	} else {
		echo "Nobody has made a post.";
	}
?>
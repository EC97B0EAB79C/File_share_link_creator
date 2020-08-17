<?php
do{
	$rand_str = substr(md5(microtime()),rand(0,26),5);
	$target_dir = "../share/" . $rand_str . "/";
}
while (is_dir($target_dir));

mkdir($target_dir);
$file_name = basename($_FILES["fileToUpload"]["name"]);
$file_name = str_replace(array(";","&#","'"),"",$file_name);
$target_file = $target_dir . $file_name;

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	$html_file = fopen($target_dir . "index.html","w");
	fwrite($html_file, "<html>\n<head>\n<title> Download </title>\n</head>\n");
	fwrite($html_file, "<body onload=" . '"' . "javascript:window.location.href='" . $file_name . "';" . '"' . ">\n");
	fwrite($html_file, "<p>If download does not start automatically click <a href='" . $file_name . "'>here<a>.</p>\n</body>\n</html>");
	fclose($html_file);
        echo $file_name . " has been uploaded.<br>Share link: ";
	$link = "https://YOUR.LINK.HERE/share/" . $rand_str . "/";
	echo "<a href='" . $link . "'>" . $link .  "  </a>";	
} else {
        echo "Sorry, there was an error uploading your file.";
}
?>


<?php
$dir = '/mnt/snowy/Music'.urldecode($_GET["path"]);
if(!strrpos($dir, '/../')){
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				if(filetype($dir.$file) == "dir"){
					if($file != "." && $file != "Scans")
						echo '<div class="folder"><a href="'.$_GET["path"].$file.'/">'.$file."</a></div>\n";
				}
				elseif(filetype($dir.$file) == "file"){
					if($file == "cover.jpg")
						echo '<div class="cover">'."</div>\n";
					else
						echo '<div class="file"><a href="'.$_GET["path"].$file.'">'.substr($file,0,-4)."</a></div>\n";
				}
			}
			closedir($dh);
		}
	}
}
?>
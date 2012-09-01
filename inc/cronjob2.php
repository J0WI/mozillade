<?php

$planet = simplexml_load_file("http://planet.mozilla.de/atom.xml");
$i = 0;
$count = 5;

ob_start();
echo "<ul>";

foreach ($planet->entry as $entry) {

	if ($i < $count) {

		echo "\t".'<li><a class="post" href="'.htmlspecialchars($entry->link["href"]).'">'.$entry->title.'</a>'."\n";
		
		foreach ($entry->source->link as $link) {
			if ($link["type"] == "text/html" && $link["rel"] == "alternate") {
				$source = htmlspecialchars($link["href"]);
			}
		}

		echo "\t".'<div>von <a class="author" href="'.$source.'">'.$entry->author->name.'</a></div></li>'."\n";

		$i++;

	} else {
echo "</ul>";
		break;

	}
}

$cache = fopen('planet2.html', 'w');
fwrite($cache, ob_get_clean());
fclose($cache);

?>

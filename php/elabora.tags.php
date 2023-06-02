<?php 
				include "../php/config.ini.php";
				include "db.inc.php";
				$conn = new FUNCT("eventi");
				$conn->doServer();
				$tags = $conn->prelevaTags($pagine);
				//exit(var_dump($tags)); 
				echo "<div class='titolo-tendina'>TAGS</div>";
				echo "<ul  style='list-style: circle inside;'>";
				foreach ( $tags as $voce )
					{
						echo "<li onclick='getTag(\"" . $voce . "\");'>" . $voce . "</li>";
					}
				echo "</ul>";


?>
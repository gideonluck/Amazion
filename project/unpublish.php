<?php

			$link =  mysql_connect("localhost","root","");

			if (!$link) {
    			printf("Connect failed: %s\n", mysql_error());
    			exit();
			}

			$db_selected = mysql_select_db("user", $link);

			if (!$db_selected) {
    			die("Database selection failed: " . mysql_error());
			}
			if(isset($REQUEST["action"]))
				$action = $_REQUEST["action"];
			else
				$action = "none";

			$sql = "SELECT id, title, date1, story, approved, submitted_by, photo FROM stories";


			$result = mysql_query("select * from stories");;



					echo "hello";
					$id = $row["id"];

					$r = mysql_query("UPDATE stories SET approved='0' WHERE id='" . $id . "'");
					if(!$result)
						die ('Can\'t query users because: ' . mysql_error());
					else
						echo "Story Unpublished";

				?>
		<?php
		//REVIEWS
			$link =  mysqli_connect("localhost","root","","amazion");

			if (!$link) {
    			printf("Connect failed: %s\n", mysqli_error());
    			exit();
			}

				$user = $_POST['user'];
				$rate = $_POST['rate'];
				$review = $_POST['review'];
				$id = NULL; //not sure about this


				$sql = "INSERT INTO review (id, user, rate, review) VALUES ('$id', '$user', '$rate', '$review')";

				$result = mysqli_query($link,$sql);
				if (!$result) {
				   printf("Connect failed: %s\n", mysqli_error($link));
				};
				mysqli_close();

				header('Location: homepage.php');
		?>
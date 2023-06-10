<!DOCTYPE html>
<html>
<head>
	<title>Chessboard</title>
	<style>
		.board {
			display: grid;
			grid-template-columns: repeat(8, 50px);
			grid-template-rows: repeat(8, 50px);
		}
        
		.board div {
            width: 50px;
			height: 50px;
			font-size: 30px;
			text-align: center;
			line-height: 50px;
            border: 5px solid black;
		}

		.white {
			background-color: white;
			color: black;
		}

		.black {
			background-color: black;
			color: white;
		}
	</style>
</head>
<body>
	<div class="board">
		<?php
			for ($i = 1; $i <= 8; $i++) {
				for ($j = 1; $j <= 8; $j++) {
					if (($i + $j) % 2 == 0) {
						echo '<div class="white"></div>';
					} else {
						echo '<div class="black"></div>';
					}
				}
			}
		?>
	</div>
</body>
</html>

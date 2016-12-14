<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciador PPU - índice</title>
  <script type="text/javascript" src="libs/jquery.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <link href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="libs/bootstrap/js/bootstrap.min.js"></script>
	

</head>
<body>

	<?php include "container.php"; 

		for ($i=1; $i < 15 ; $i++) { 
			
			if ($i < 10) {
			
				$arquivo = fopen('C0'.$i.'.html','w+');
				$arquivo = fopen('C0'.$i.'E.html','w+');

			}else{

				$arquivo = fopen("C".$i.'.html','w+');
				$arquivo = fopen("C".$i.'E.html','w+');

			}

			

		if ($arquivo == false) die('Não foi possível criar o arquivo.');

			fclose($arquivo);

		}

		include "conteudo/indiceE.php";

	?>

			
	</div>

</body>
</html>
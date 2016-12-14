<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciador PPU</title>
  <script type="text/javascript" src="libs/jquery.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <link href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="libs/bootstrap/js/bootstrap.min.js"></script>
 
	

</head>
<body>

	<?php include "container.php"; ?>

<?php 
			
	// função útil para unir vários arquivos de scripts em um único arquivo
		function union(array $files,$name){
		    
		    // criamos a variável
		    $union = NULL;
		    
		    for($i=0;$i<count($files);$i++){
		       
		        // o arquivo existe ?
		        if(file_exists($files[$i])){
		       
		            // concatenamos os arquivos e inserimos uma quebra de linha
		            $union .= file_get_contents($files[$i])."\n";
		       
		        }
		           
		    }
		    
		    // criamos um arquivo e abrimos somente para escrita    
		    $fp = fopen($name,"w");
		    
		    // escrevemos o conteúdo da variável
		    fwrite($fp,$union);
		       
		    // fechamos o arquivo
		    fclose($fp);
		    
		}


	if($_POST["editor1"] == null){

		
		echo '<p class="bg-danger">Não há informação para ser enviada.</p>';
		echo "<center><a style='margin-right: 15px;'class='btn btn-default' href='index.php'>Voltar ao Índice</a></center>";

	}else{

		$id = $_GET["id"];

		if($id == "indice"){
		
			//$arquivo = fopen("conteudo/".$id.".php",'w+');
			$arquivoE = fopen("conteudo/".$id."E.php",'w+');

		}else{
			//$arquivo = fopen("conteudo/".$id.".html",'w+');
			$arquivoE = fopen("conteudo/".$id."E.html",'w+');


		}

		

		if ($arquivoE) {

			
			//todos os replaces abaixo servem para limpar códigos indesejados adicionados pelo editor.
			$tratamento = str_replace("mce-","",$_POST["editor1"]);
			$tratamento = str_replace("// <![CDATA[","",$tratamento);
			$tratamento = str_replace("// ]]>","",$tratamento);
			$tratamento = str_replace("type=\"no/type\"","type=\"text/javascript\"",$tratamento);
			$tratamento = str_replace("<script>","<script type=\"text/javascript\">",$tratamento);
			$tratamento = str_replace("<span id=\"CmCaReT\"></span>","",$tratamento);
			$tratamento = str_replace("\"images/","\"../images/",$tratamento);
			$tratamento = str_replace("\"uploads/","\"../uploads/",$tratamento);


					

			if (!fwrite($arquivoE, $tratamento)) die('<p class="bg-danger"><br>Problema ao salvar o arquivo.<br></p>');
			echo '<p class="bg-success ">Arquivo atualizado com sucesso.</p>';

			fclose($arquivoE);

			if($id != "indice"){
				union(array("header.html","conteudo/".$id."E.html","footer.html"),"conteudo/".$id.".html");
			}

			echo "<center><a style='margin-right: 15px;'class='btn btn-default' href='index.php'>Voltar ao Índice</a>";
			echo "<a style='margin-right: 15px;' class='btn btn-default' href='gerenciador.php?id=".$_GET["id"]."&titulo=".$_GET["titulo"]."'>Voltar para edição</a>";

			if($id == "indice"){

				echo "<a class='btn btn-default' href='index.php' target='_blank'>Visualizar</a></center>";

			}else{

				echo "<a class='btn btn-default' href='conteudo/".$_GET["id"].".html' target='_blank'>Visualizar</a></center>";


			}


			echo "<hr><br><h3>Preview:</h3>";
			echo "<div style='padding: 20px; border: 1px solid #ccc;'>".$_POST["editor1"]."</div><br><br>";

		}else{
			echo '<p class="bg-danger">Problema ao salvar o arquivo.</p>';
		}

	}

	
	


?>
</div>
</body>
</html>
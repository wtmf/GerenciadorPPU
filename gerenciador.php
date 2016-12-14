<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciador PPU - Edição</title>
  <script type="text/javascript" src="libs/jquery.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="libs/tinymce/js/tinymce/tinymce.min.js"></script>
  <link href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="libs/bootstrap/js/bootstrap.min.js"></script>
	

</head>
<body>

  <?php include "container.php"; ?>


	<?php


		$id = $_GET["id"];
    $titulo = $_GET["titulo"];

    if($id == "indice"){
      $arquivo = fopen("conteudo/".$id."E.php",'r'); //abre o arquivo e permite a leitura/escrita

    }else{
      $arquivo = fopen("conteudo/".$id."E.html",'r'); //abre o arquivo e permite a leitura/escrita
     // echo "teste";
    }

		



		if ($arquivo == false) die('O arquivo não existe.');

		$temp = "";
    

		while(true) {

			$linha = fgets($arquivo); //lê arquivo linha por linha 
      //echo $linha."<br>";

      if ($linha==null){

        break; //fim do arquivo

      } 

       $temp = $temp.htmlspecialchars($linha);
        
    }

     
      
			
		

    $temp = str_replace("../images/", "images/",$temp); //converte o caminho das imagens para que sejam visualizadas no editor
    $tratamento = str_replace("\"../uploads/","\"uploads/",$tratamento);

		fclose($arquivo);

	?>

	<?php 

    echo "<h4> Editando: <strong>".$titulo."</strong></h4>";
    echo "<form action='sucesso.php?id=".$id."&titulo=".$titulo."' method='post'>" ; 

  ?>

    <textarea id="editor1" name="editor1" html="true" cols="50" rows="30">
      <?php echo $temp; ?>
    </textarea>

    <br>
    
    <input style="float: right;" type="submit" class="btn btn-primary" value="Salvar">
    <a style="float: right; margin-right: 15px;" href="index.php" class="btn btn-default">Cancelar</a>

    </form>

    <?php
		if (isset( $_GET['a'] ) && $_GET['a'] == 1 && $_POST['editor1'] != '' ) {
			salvar();
		}
	?>

     <script type="text/javascript">

        //Configurações do Editor

        tinymce.init({
        selector: "textarea",
        height: '400px',
        theme: "modern",
        plugins: [
            "advlist autolink code lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern jbimages codemirror"
        ],
        toolbar1: " undo redo | styleselect | fontselect |  fontsizeselect | forecolor backcolor | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink image jbimages | hr table fullscreen | print preview media | code ",
        image_advtab: true,
        templates: [
            {title: 'Test template 1', content: 'Test 1'},
            {title: 'Test template 2', content: 'Test 2'}
        ],
        file_browser_callback: RoxyFileBrowser,
        codemirror: {
        indentOnInit: true, // Whether or not to indent code on init. 
        path: 'CodeMirror', // Path to CodeMirror distribution
        config: {           // CodeMirror config object
           mode: 'application/x-httpd-php',
           lineNumbers: true
        },
        jsFiles: [          // Additional JS files to load
           'mode/clike/clike.js',
           'mode/php/php.js',
           'mode/javascript/javascript.js'
        ],
        cssFiles:[
           'theme/neat.css',
           'theme/base16-dark.css'
        ]
      }
});

function RoxyFileBrowser(field_name, url, type, win) {
  var roxyFileman = 'libs/tinymce/js/tinymce/plugins/fileman/index.html';
  if (roxyFileman.indexOf("?") < 0) {     
    roxyFileman += "?type=" + type;   
  }
  else {
    roxyFileman += "&type=" + type;
  }
  roxyFileman += '&input=' + field_name + '&value=' + document.getElementById(field_name).value;
  if(tinyMCE.activeEditor.settings.language){
    roxyFileman += '&langCode=' + tinyMCE.activeEditor.settings.language;
  }
  tinyMCE.activeEditor.windowManager.open({
     file: roxyFileman,
     title: 'Roxy Fileman',
     width: 850, 
     height: 650,
     resizable: "yes",
     plugins: "media",
     inline: "yes",
     close_previous: "no"  
  }, {     window: win,     input: field_name    });
  return false; 
}

</script>

  
</div>



</body>

</html>
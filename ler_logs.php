<?php

$controlador;


if ($controlador == 1 ) {

	$arquivo = fopen ('/home/pi/Arquivos/Logs/creditos.txt', 'r');

	// Lê o conteúdo do arquivo 
	while(!feof($arquivo))
	{

		$linha = fgets($arquivo, 1024);
			echo $linha.'<br />';
	}

	fclose($arquivo);

}

elseif ($controlador == 2) {
	$arquivo = fopen ('/home/pi/Arquivos/Logs/log_refeicoes.txt', 'r');

	// Lê o conteúdo do arquivo 
	while(!feof($arquivo))
	{

		$linha = fgets($arquivo, 1024);
			echo $linha.'<br />';
	}

	fclose($arquivo);
}

elseif ($controlador == 3) {
	$arquivo = fopen ('/home/pi/Arquivos/Logs/excluidos.txt', 'r');

	// Lê o conteúdo do arquivo 
	while(!feof($arquivo))
	{

		$linha = fgets($arquivo, 1024);
			echo $linha.'<br />';
	}

	fclose($arquivo);
}

else{

	echo 'Ops algum erro aconteceu';
}


?>

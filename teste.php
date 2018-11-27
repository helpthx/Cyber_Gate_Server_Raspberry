<?php
        // Criamos o arquivo do usuário com w+
        $cria = fopen("/creditos.txt", "w+");

        // Aqui iremos declarar as informações do usuário
        // São separadas por | para depois podermos recupera-las com explode
        $dados .= "$Oi mundo";
        
        // Agora escrevemos estes dados no arquivo
        $escreve = fwrite($cria,$dados);

        // Fechando o arquivo
        fclose($cria);


?>

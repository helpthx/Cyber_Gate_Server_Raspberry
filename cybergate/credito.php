<!DOCTYPE html>
<html lang="en">
<head>
   <title>Cyber Gate controle de acessos</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
   <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="css/util.css">
   <link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
<form method = "post" action="credito.php">
   <div class="oz-body-wrap">
      <!-- Start Header Area -->
      <header class="default-header">
         <div class="container-fluid">
            <div class="header-wrap">
               <div class="header-top d-flex justify-content-between align-items-center">
                  <div class="logo">
                     <a href="../index/index.html"><img src="img/logo.png" alt=""></a>
                  </div>
                  <div class="main-menubar d-flex align-items-center">
                     <nav class="hide">
                        <a href="../index/index.html">Home</a>
                        <a href="generic.html"></a>
                        <a href="elements.html"></a>
                     </nav>
                     <div class="menu-bar"><span class="lnr lnr-menu"></span></div>
                  </div>
               </div>
            </div>
         </div>

   <div class="container-contact100">
      <div class="wrap-contact100">
         <form class="contact100-form validate-form">
            <span class="contact100-form-title">
               <center>
          <img src="images/logo.png" alt="some text" width=500 height=500>
            </center>
               Painel para adicionar créditos
            </span>
         
            <label class="label-input100" for="Matricula">Digite a matricula *</label>
            <div class="wrap-input100 validate-input" data-validate = "Entre com uma Matricula valida">
               <input id="Matricula" class="input100" type="number" name="Matricula" placeholder="00000000">
               <span class="focus-input100"></span>
            </div>

            <label class="label-input100" for="Dinheiro">Digite a quantidade de créditos *</label>
            <div class= "wrap-input100">
               <input id="Dinheiro" class="input100" type="number" name="Dinheiro" placeholder="00.00" step="0.01">
               <span class="focus-input100"></span>
            </div>

         
            <div class="container-contact100-form-btn">
               <button class="contact100-form-btn">
                  Adicionar
               </button>
            </div>
         </form>

         
         </div>
      </div>
   </div>
 </form>


   <div id="dropDownSelect1"></div>

<!--===============================================================================================-->
   <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
   <script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
   <script src="vendor/bootstrap/js/popper.js"></script>
   <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
   <script src="vendor/select2/select2.min.js"></script>
   <script>
      $(".selection-2").select2({
         minimumResultsForSearch: 20,
         dropdownParent: $('#dropDownSelect1')
      });
   </script>
<!--===============================================================================================-->
   <script src="vendor/daterangepicker/moment.min.js"></script>
   <script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
   <script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
   <script src="js/main.js"></script>
   <!-- Global site tag (gtag.js) - Google Analytics -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
   <script>
     window.dataLayer = window.dataLayer || [];
     function gtag(){dataLayer.push(arguments);}
     gtag('js', new Date());

     gtag('config', 'UA-23581568-13');
   </script>
</body>
</html>
 
<?php

  $Matricula = $_POST['Matricula'];
  $Dinheiro = $_POST['Dinheiro'];
   class MyDB extends SQLite3 {
      function __construct() {
         $this->open('/home/pi/Banco_de_dados.db');
      }
   }

   
   
   $db = new MyDB();
   if(!$db) {
      echo $db->lastErrorMsg();
   } else {
      echo "Banco aberto com sucesso...<br />\n";
   }

   $sql =<<<EOF
      UPDATE CADASTROS set RU = RU +'$Dinheiro' WHERE  MATRICULA = '$Matricula';
      

EOF;

   $ret = $db->exec($sql);
   if(!$ret) {
      echo $db->lastErrorMsg();
   } else {
      echo $db->changes(), " Cadastro atualizado com sucesso...<br />\n";

   $cria = fopen("/home/pi/Arquivos/Logs/creditos.txt", "a+");
   
   
   $today = date("Y-m-d H:i:s"); 
   $frase_matricula = "\n-------------------\n" .$today . "\nMatricula: " . $Matricula . "\n";
   $frase_dinheiro = "Foi adicionado: R$" . $Dinheiro . " \n-------------------"; 
   $dados .= $frase_matricula .  $frase_dinheiro;
   
   $escreve = fwrite($cria,$dados);
   // Fechando o arquivo
   fclose($cria);
  

   }

 $sql =<<<EOF
      SELECT * from CADASTROS WHERE MATRICULA = '$Matricula';
EOF;
	
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
      echo ("<br />\nID = ". $row['ID'] . "<br />\n");
      echo ("NOME = ". $row['NOME'] ."<br />\n");
      echo ("MATRICULA = ". $row['MATRICULA'] ."<br />\n");
      echo ("RU = ".$row['RU'] ."<br />\n");
      echo ("ACESSOS = ".$row['ACESSOS'] ."<br />\n");
   }
   echo "<br />\nOperação feita com sucesso...<br />\n";
   $db->close();
   
?>
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
<form method = "post" action="excluir.php">
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
               Painel para iniciar nova refeição
            </span>
         
            <label class="label-input100" for="Dinheiro">Escolha a refeição que será iniciada *</label>
            
            <div class= "wrap-input100">
               <center>
               <div class="container-contact100-form-btn">
                        <button class="contact100-form-btn" >
                           <input id="Cafe_da_manha" type="button" name="Cafe_da_manha">
                        Café da Manhã
                     </button>
                  </div>
               <div class="container-contact100-form-btn">
                        <button class="contact100-form-btn">   
                           <input id="almoco" type="button" name="almoco">
                         Almoço
                     </button>
                  </div>
               <div class="container-contact100-form-btn">
                        <button class="contact100-form-btn">
                           <input id="jantar" type="button" name="jantar">
                        Jantar
                     </button>
                  </div>
                </center>
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
  class MyDB extends SQLite3 {
      function __construct() {
         $this->open('/opt/lampp/htdocs/dashboard/Banco_de_dados.db');
      }
   }

   
   
   $db = new MyDB();
   if(!$db) {
      echo $db->lastErrorMsg();
   } else {
      echo "Banco aberto com sucesso...<br />\n";
   }

   $sql =<<<EOF
      UPDATE CADASTROS set NOME = "DESCADASTRADO", MATRICULA = 00000000 , RU = 00.00,  ACESSOS = 0 WHERE  MATRICULA = '$Matricula';
      

EOF;

   $ret = $db->exec($sql);
   if(!$ret) {
      echo $db->lastErrorMsg();
   } else {
      echo $db->changes(), " Cadastro deletado com sucesso...<br />\n";
   }
   echo "<br />\nOperação feita com sucesso...<br />\n";
   $db->close();
?>
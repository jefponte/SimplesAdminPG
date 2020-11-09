<?php
use SimplesAdminPG\AdminPG;
include_once "SimplesAdminPG/AdminPG.php";
if (! isset($_SESSION)) {
    session_start();
}
if(isset($_GET['sair'])){
    if (isset($_SESSION)) {
        session_destroy();
    }
    echo '<meta http-equiv="refresh" content=0;url="./index.php">';
}
if(isset($_GET['dbname'])){
    $_SESSION['dbname'] = $_GET['dbname'];
    echo '<meta http-equiv="refresh" content=0;url="./index.php">';
    
}
echo '
<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Hello, world!</title>

</head>
<body>

    
     
          ';
if(isset($_SESSION['ATIVO'])){
    echo '
<header>
 <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Fixed navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
        <form id="form-dbname" class="form-inline mt-2 mt-md-0">
            <select class="form-control mr-sm-2" type="text" aria-label="Search" name="dbname">
            <option value="">Selecione um banco de dados</option>
                ';
    if(isset($_SESSION['dbname'])){
        echo '
                <option value="'.$_SESSION['dbname'].'" selected>'.$_SESSION['dbname'].'</option>
';
    }
    
    try{
        $conexao = new PDO( 'pgsql:host='.$_SESSION['host'].' port='.$_SESSION['port'].'  user='.$_SESSION['user'].' password='.$_SESSION['password']);
        $result = $conexao->query("SELECT datname FROM pg_database;");
        
        foreach($result as $linha){
            echo '
                <option value="'.$linha['datname'].'">'.$linha['datname'].'</option>
';
            
        }
        
    }catch(\Exception $e){
        echo $e -> getmessage();
        unset($_SESSION['ATIVO']);
    }
    
    
    echo '

            </select>
            <a href="?sair=1" class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</a>
          </form>
        </div>
      </nav>
</header>
';
    
}

echo '


    

    <!-- Begin page content -->
    <main role="main" class="container">
      <h1 class="mt-5">SimplesAdminPG</h1>
      <p class="lead">Uma forma mais simples de manipular o banco de dados postgres.</p>
      ';
if(!isset($_SESSION['ATIVO'])){
    AdminPG::tentarLogin();
    AdminPG::formLogin();
}else{

    if(isset($_SESSION['host']) && isset($_SESSION['port']) && isset($_SESSION['user']) && isset($_SESSION['password']) && isset($_SESSION['dbname']) ) {
        try{
            $conexao = new PDO( 'pgsql:host='.$_SESSION['host'].' port='.$_SESSION['port'].'  dbname='.$_SESSION['dbname'].'  user='.$_SESSION['user'].' password='.$_SESSION['password']);
            AdminPG::main($conexao);
            
        }catch(\Exception $e){
            echo $e -> getmessage();
            unset($_SESSION['dbname']);
            echo '<meta http-equiv="refresh" content=3;url="./index.php">';
        }
        
        
    }elseif(isset($_SESSION['host']) && isset($_SESSION['port']) && isset($_SESSION['user']) && isset($_SESSION['password'])){
        try{
            $conexao = new PDO( 'pgsql:host='.$_SESSION['host'].' port='.$_SESSION['port'].'  user='.$_SESSION['user'].' password='.$_SESSION['password']);
            $result = $conexao->query("SELECT datname FROM pg_database;");
            
            foreach($result as $linha){
                echo '<a href="?dbname='.$linha['datname'].'">'.$linha['datname'].'</a>';
                echo '<br>';
            }
            
        }catch(\Exception $e){
            echo $e -> getmessage();
            unset($_SESSION['ATIVO']);
        }
        
        
        
    }
    
//     $conexao = new PDO( 'pgsql:host=localhost port=5432 dbname=ocorrencias user=postgres password=postgres');
    
    
}

echo '

    </main>

    <footer class="footer">
      <div class="container">
        <span class="text-muted">SimplesAdminPG.</span>
      </div>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script>
        $( "#form-dbname" ).on(\'change\', function(e) {
            var dados = jQuery(this).serialize();
            
    		jQuery.ajax({
                type: "GET",
                url: "index.php",
                data: dados,
                success: function( data )
                {
    				console.log("Foi");
                    window.location.href=\'index.php\';
    
                }
            });
            
        });
        
    </script>
  </body>
</html>';
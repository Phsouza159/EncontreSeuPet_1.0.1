
<html>
    <head>
        <title>Login</title>
        <meta name="viewport" content="width=device-width">
        <!--Chamar folha css (LESS) -->
        <link rel="stylesheet/less" type="text/css" href="App/View/Contents/css/Index.less" />
        <!-- Chamar biblioteca (LESS)-->
        <script src="./App/View/Contents/plugins/less/dist/less.js" ></script>
        <!-- Chamar biblioteca (BOOSTSTRAP)-->
        <link rel="stylesheet" type="text/css" href="./App/View/Contents/plugins/bootstrap/css/bootstrap.css">
        
        <style type="text/css">
            body {
                background-color: rgb(65 , 64 , 65);
            }
        </style>
        <script type="text/javascript">
            
            var tempo = 1;

            function CarregarProgress()
            {
                var e = tempo;
                
                var element = document.getElementById("PORC");
                    element.innerHTML = e + "%";
                
                element = document.getElementById("bar-prog");
                    element.style.width = e + "%";
               
                element = document.getElementById("descricaoCarregamento");
                   
                switch(tempo)
                {
                    case 1:
                        element.innerHTML = "Carregando...";
                        break;
                    case 25:
                        element.innerHTML = "Carregando...";
                        break;
                        
                    case 50:
                        element.innerHTML = "Carregando...";
                        break;
                        
                    case 75:
                        element.innerHTML = "Carregando...";
                        break;    
                    
                    case 99:
                        element.innerHTML = "Carregamento Completo";
                        break;    
                       
                    default:
                        break;
                }
                   
                   
        
                if(e >= 100)
                {
                    setTimeout("self.location.href='./App/View/Site/Home.php';", 1999);
                    return;
                }
                
                tempo++;
                setTimeout( "CarregarProgress()",50);
            }
            
            
//setTimeout( CarregarProgress(), 2999);
            function tempo() {
               // setTimeout("self.location.href='./App/View/Site/Home.php';", 4999);
            }
            //onLoad= tempo()
        </script>

    </script> 
</head>
<body class="grid-container" onLoad="CarregarProgress()">
    
    <center>
        <div class="img-logo"></div>
        <div class="corpo-progresso justify-content-center">
        <h1><span id="PORC"></span></h1>
            <div aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" id="bar-prog" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <span id="descricaoCarregamento"></span>
        </div>
        
    </center>
        <!--
       <form action="index.php" method="POST">
            <lable>Usuário:</lable>
            
            <input type='hidden' value='login' name='ACAO_FORM' />
            
            <input name="user_log" value='' type="text" required='true'/>
                </br>
            <label>Senha:</label>
            <input name="pass_log" value='' type="password" required='true'/>
                </br>
            <input type="submit" value='Login' name="Enviar" />
       </form>
-->
    <script src="App/View/Contents/js/jquery3.3.1.js"></script>
   
</body>
</html>

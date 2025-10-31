<?php
    include '../config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Registrar-se</title>
</head>
<body>
    <div id='alinhar__texto'>
        <img id="icone" src='../assets/icons/icone__principal.png'>
        <p id='bem__vindo'>Bem vindo!</p>
    </div>

    <div class="invisivel"></div>

    <form method="POST" action="">
        <div class='brazul'>
            <div>
                <input type='email' class="text__box" name='email' placeholder="Email" required>
            </div>
        </div>

        <div class='brazul'> 
            <div>
                <input type='text' class="text__box" name='usuario' placeholder="Usuário" required>
            </div>
        </div>

        <div class='id'>
            <div>
                <input type='password' class="text__box" name='senha' placeholder="Senha..." required>
            </div>
        </div>

        <div class='brazul'>
            <div>
                <input type='text' class="text__box" name='numero' placeholder="Número" required>
            </div>
        </div>

        <div class='brazul__b'>
            <div class="opacity">
                <button class="button" type="submit">Registrar-se</button>
            </div>
        </div>
    </form>
       
        <div class='voltar'>
            <div class="opacity">
               <a href="login.php"><button class="button"  type="">Voltar</button></a> 
            </div>
        </div>      
        
    

      <div class="enterprise">
        <p>Goudard Enterprise</p>
      </div>      
</body>
</html>
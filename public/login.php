 <?php
  include '../config/db.php'
 ?>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>login</title>
 </head>

 <body>
   
      <div id='alinhar__texto'>
            <img id='icone' src="../assets/icons/icone__principal.png">
           <p id='bem__vindo'>Bem vindo!</p>
      </div>
        <div class='idr'>
            <a href="registrar__se.php">
                <div class="opacity">
                   <button class="button">Registrar-se</button>
                </div>
            </a>
        </div> 
        
       <h4 class="jc">ja tem uma conta?</h4>
       <?php if (!empty($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
       <form method="POST" action="login.php">
            <div class='id'> 
                <div><input type='text' class="text__box" name='usuario' placeholder="Usuário..." required></div>
            </div>
            <div class='id'>
                <div><input type='password' class="text__box" name='senha' placeholder="Senha..." required></div>
            </div>
            <div class='idl'>
                <div class="opacity">
                   <button class="button" type="submit">Fazer login</button>
                </div>
            </div>
       </form>
        
        <div class='enterprise'>
            <p>trem Enterprises</p>
        </div>

 </body>
</html>

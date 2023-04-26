<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once('Password.php'); 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Gerador de Senha</title>
</head>
<body>
<?php

function sortChar($characters){
  return $characters[random_int(0, strlen($characters) -1)];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $length = $_POST['length']??8;
  $use_symbols = isset($_POST['use_symbols']);
  $use_numbers = isset($_POST['use_numbers']);
  $use_uppercase = isset($_POST['use_uppercase']);
  $use_lowercase = isset($_POST['use_lowercase']);

  $symbols = '!@#$%^&*()_+-=';
  $numbers = '0123456789';
  $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $lowercase = 'abcdefghijklmnopqrstuvwxyz';
  
  $charactersAlreadyChosen = 0;
  $characters = '';
  $password = '';

  if ($use_symbols) {
    $characters .= $symbols;
    $password .= sortChar($symbols);
    $charactersAlreadyChosen++;
  }
  if ($use_numbers) {
    $characters .= $numbers;
    $password .= sortChar($numbers);
    $charactersAlreadyChosen++;
  }
  if ($use_uppercase) {
    $characters .= $uppercase;
    $password .= sortChar($uppercase);
    $charactersAlreadyChosen++;
  }
  if ($use_lowercase) {
    $characters .= $lowercase;
    $password .= sortChar($lowercase);
    $charactersAlreadyChosen++;
  }

  if($password == ''){
    $characters = $symbols.$uppercase.$lowercase.$numbers;
  }

  for ($i = 0; $i < ($length - $charactersAlreadyChosen); $i++) {
    $password .= $characters[random_int(0, strlen($characters) - 1)];
  }


}
?>
<h1>Gerador de Senhas</h1>
<form method="post">
  <div class="comp">
    <label for="length">Comprimento da Senha:</label>
    <input type="number" name="length" id="length" min="1" max="100"  placeholder="Tamanho da senha" class="length" required><br>
  </div>

  <div class="comp">
    <label for="use_symbols">Incluir símbolos</label>
    <input type="checkbox" name="use_symbols" id="use_symbols">
    <br>
  </div>

  <div class="comp">
    <label for="use_numbers">Incluir números</label>
    <input type="checkbox" name="use_numbers" id="use_numbers">
    <br>
  </div>
  <div class="letras">
      <label for="use_uppercase">Incluir letras maiúsculas</label>
      <input type="checkbox" name="use_uppercase" id="use_uppercase">
  </div>

  <div class="letras">
      <label for="use_lowercase">Incluir letras minúsculas</label>
      <input type="checkbox" name="use_lowercase" id="use_lowercase">
    </div>
    <br>
  

  <button type="submit">Gerar senha</button>

  <p><?php echo "Senha Gerada: " . $password?></p>
</form>

</body>
</html>
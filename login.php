<?php

function realizarAnaliseLexica($codigo) {
    
    $padraoPalavrasChave = "/\b(if|else|for|while|do|break|class|public|private)\b/";
    $padraoIdentificadores = "/\b[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*\b/";
    $padraoOperadores = "/[\+\-\*\/=<>]/";
    $padraoDelimitadores = "/[\(\)\{\}\[\]\.,;]/";

 
    preg_match_all($padraoPalavrasChave, $codigo, $palavrasChaveEncontradas);
    preg_match_all($padraoIdentificadores, $codigo, $identificadoresEncontrados);
    preg_match_all($padraoOperadores, $codigo, $operadoresEncontrados);
    preg_match_all($padraoDelimitadores, $codigo, $delimitadoresEncontrados);

 
    echo "<h2>Resultado da Análise Léxica:</h2>";
    echo "<strong>Palavras-chave encontradas:</strong> " . implode(", ", $palavrasChaveEncontradas[0]) . "<br>";
    echo "<strong>Identificadores encontrados:</strong> " . implode(", ", $identificadoresEncontrados[0]) . "<br>";
    echo "<strong>Operadores encontrados:</strong> " . implode(", ", $operadoresEncontrados[0]) . "<br>";
    echo "<strong>Delimitadores encontrados:</strong> " . implode(", ", $delimitadoresEncontrados[0]) . "<br>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["codigo"])) {
    $codigoInserido = $_POST["codigo"];
    realizarAnaliseLexica($codigoInserido);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Análise Léxica</title>
</head>
<body>
    <h1>Análise Léxica de Código</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="codigo">Insira o código a ser analisado:</label><br>
        <textarea id="codigo" name="codigo" rows="10" cols="50"></textarea><br>
        <input type="submit" value="Analisar">
    </form>
</body>
</html>

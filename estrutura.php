<!DOCTYPE html>
<html>
<head>
    <title>Análise Léxica de Código</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .code-label {
            font-family: Arial, sans-serif;
            font-weight: bold;
            font-size: 25px; 
            display: flex;
            align-items: center;
            gap: 10px; 
        }

        .logo-linguagem {
            width: 50px; 
        }

        #linguagem {
            width: 120px; 
            padding: 8px; 
            border-radius: 5px; 
            border: 2px solid #ccc; 
            font-size: 20px; 
            font-family: 'Times New Roman'
        }
        
        .custom-select,
        input[type="submit"] {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="logo-container">
        <img src="https://d9hhrg4mnvzow.cloudfront.net/lp.fpb.edu.br/fpb-formas-de-entrada/f338a297-fpb-logo-branco-sem-lau_105f014000000000000028.png" class="logo" alt="Logo animada">
    </div>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="codigo" class="code-label">
            ANALISADOR LÉXICO
            <img src="https://www.php.net/images/logos/new-php-logo.png" class="logo-linguagem" alt="Logo PHP">
            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c3/Python-logo-notext.svg" class="logo-linguagem" alt="Logo Python">
            <img src="https://seeklogo.com/images/J/java-logo-41D4155FC3-seeklogo.com.png" class="logo-linguagem" alt="Logo Java">
        </label><br>
        <textarea id="codigo" name="codigo" rows="10" cols="50" placeholder="Insira o seu código aqui"></textarea><br>
        <label for="linguagem" class="select-label">Selecione a linguagem:</label>
        <div class="custom-select">
            <select name="linguagem" id="linguagem">
                <option value="php" >PHP</option>
                <option value="python" >PYTHON</option>
                <option value="java">JAVA</option>
            </select>
        </div>
        <input type="submit" value="Analisar">
    </form>
</body>
</html>


<?php
function realizarAnaliseLexica($codigo, $linguagem) {
    
    $padraoPalavrasChave = '';
    $padraoIdentificadores = '';
    $padraoOperadores = '';
    $padraoDelimitadores = '';

    switch ($linguagem) {
        case 'php':
            $padraoPalavrasChave = "/\b(if|else|for|while|do|break|class|public|private|function|return|try|catch|finally)\b/";
            $padraoIdentificadores = "/\b(?!(if|else|for|while|do|break|class|public|private|function|return|try|catch|finally))\b[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*\b/";
            $padraoOperadores = "/[\+\-\*\/=<>]|&&|\|\|/";
            $padraoDelimitadores = "/[\(\)\{\}\[\]\.,;]/";
            break;
        case 'python':
            $padraoPalavrasChave = "/\b(if|else|for|while|def|class|import|elif|try|except|finally)\b/";
            $padraoIdentificadores = "/\b(?!(if|else|for|while|def|class|import|elif|try|except|finally))\b[a-zA-Z_][a-zA-Z0-9_]*\b/";
            $padraoOperadores = "/[\+\-\*\/=<>]|and|or|not/";
            $padraoDelimitadores = "/[\(\)\{\}\[\]\.,;]/";
            break;            
        case 'java':
            $padraoPalavrasChave = "/\b(if|else|for|while|do|break|class|public|private|static|void|interface|extends|implements|this|super)\b/";
            $padraoIdentificadores = "/\b(?!(if|else|for|while|do|break|class|public|private|static|void|interface|extends|implements|this|super))\b[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*\b/";
            $padraoOperadores = "/[\+\-\*\/=<>]|&&|\|\|/";
            $padraoDelimitadores = "/[\(\)\{\}\[\]\.,;]/";
            break;
        default:
            echo "Linguagem não suportada.";
            return;
    }

    preg_match_all($padraoPalavrasChave, $codigo, $palavrasChaveEncontradas);
    preg_match_all($padraoIdentificadores, $codigo, $identificadoresEncontrados);
    preg_match_all($padraoOperadores, $codigo, $operadoresEncontrados);
    preg_match_all($padraoDelimitadores, $codigo, $delimitadoresEncontrados);

   
    echo '<div class="resultado-analise" id="resultado-analise">';
    echo "<h2>Resultado da Análise Léxica:</h2>";
    echo "<strong><span class='cor-titulo-palavras'>Palavras-chave encontradas:</span></strong> " . implode(", ", $palavrasChaveEncontradas[0]) . "<br>";
    echo "<strong><span class='cor-titulo-identificadores'>Identificadores encontrados:</span></strong> " . implode(", ", $identificadoresEncontrados[0]) . "<br>";
    echo "<strong><span class='cor-titulo-operadores'>Operadores encontrados:</span></strong> " . implode(", ", $operadoresEncontrados[0]) . "<br>";
    echo "<strong><span class='cor-titulo-delimitadores'>Delimitadores encontrados:</span></strong> " . implode(", ", $delimitadoresEncontrados[0]) . "<br>";
    echo '</div>';
    


    echo '<script>
        setTimeout(function() {
            var resultado = document.getElementById("resultado-analise");
            resultado.style.display = "block";
        }, 1000);
    </script>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["codigo"]) && isset($_POST["linguagem"])) {
    $codigoInserido = $_POST["codigo"];
    $linguagem = $_POST["linguagem"];
    realizarAnaliseLexica($codigoInserido, $linguagem);
}
?>

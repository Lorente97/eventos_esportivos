<?php
include("conexao.php");

if(isset($_POST['salvar']))
{
    $nome = $_POST['nome'];

    $sql = "INSERT INTO equipes(nome)
            VALUES('$nome')";

    mysqli_query($conexao, $sql);

    header("Location: equipes.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nova Equipe</title>
</head>
<body>

<h1>Nova Equipe</h1>

<form method="POST">

    Nome:

    <input
        type="text"
        name="nome"
        required
    >

    <br><br>

    <button
        type="submit"
        name="salvar">
        Salvar
    </button>

</form>

<br>

<a href="equipes.php">
    Voltar
</a>

</body>
</html>
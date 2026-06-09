<?php
include("conexao.php");

if(isset($_POST['salvar']))
{
    $nome = $_POST['nome'];
    $equipe = $_POST['equipe'];

    $sql = "INSERT INTO jogadores
            (nome, equipe_id)
            VALUES
            ('$nome', $equipe)";

    mysqli_query($conexao, $sql);

    header("Location: jogadores.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Novo Jogador</title>
</head>
<body>

<h1>Novo Jogador</h1>

<form method="POST">

    Nome:

    <input
        type="text"
        name="nome"
        required
    >

    <br><br>

    Equipe:

    <select name="equipe" required>

        <option value="">
            Selecione
        </option>

        <?php

        $sql = "SELECT * FROM equipes";

        $resultado = mysqli_query($conexao, $sql);

        while($linha = mysqli_fetch_assoc($resultado))
        {
            echo "<option value='".$linha['id']."'>";
            echo $linha['nome'];
            echo "</option>";
        }

        ?>

    </select>

    <br><br>

    <button type="submit" name="salvar">
        Salvar
    </button>

</form>

<a href="jogadores.php">
    Voltar
</a>

</body>
</html>
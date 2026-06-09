<?php
include("conexao.php");

$id = $_GET['id'];

$sql = "SELECT * FROM jogadores
        WHERE id = $id";

$resultado = mysqli_query($conexao, $sql);

$dados = mysqli_fetch_assoc($resultado);

if(isset($_POST['atualizar']))
{
    $nome = $_POST['nome'];
    $equipe = $_POST['equipe'];

    $sql = "UPDATE jogadores
            SET nome = '$nome',
                equipe_id = $equipe
            WHERE id = $id";

    mysqli_query($conexao, $sql);

    header("Location: jogadores.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Alterar Jogador</title>
</head>
<body>

<h1>Alterar Jogador</h1>

<form method="POST">

    Nome:

    <input
        type="text"
        name="nome"
        value="<?php echo $dados['nome']; ?>"
        required
    >

    <br><br>

    Equipe:

    <select name="equipe" required>

        <?php

        $sqlEquipe = "SELECT * FROM equipes";

        $resultadoEquipe = mysqli_query($conexao, $sqlEquipe);

        while($equipe = mysqli_fetch_assoc($resultadoEquipe))
        {
            $selected = "";

            if($dados['equipe_id'] == $equipe['id'])
            {
                $selected = "selected";
            }

            echo "<option value='".$equipe['id']."' $selected>";
            echo $equipe['nome'];
            echo "</option>";
        }

        ?>

    </select>

    <br><br>

    <button type="submit" name="atualizar">
        Atualizar
    </button>

</form>

<a href="jogadores.php">
    Voltar
</a>

</body>
</html>
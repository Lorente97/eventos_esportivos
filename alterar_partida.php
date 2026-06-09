<?php
include("conexao.php");

$id = $_GET['id'];

$sql = "SELECT * FROM partidas
        WHERE id = $id";

$resultado = mysqli_query($conexao, $sql);

$dados = mysqli_fetch_assoc($resultado);

if(isset($_POST['atualizar']))
{
    $competicao = $_POST['competicao'];
    $casa = $_POST['casa'];
    $visitante = $_POST['visitante'];

    if($casa != $visitante)
    {
        $sql = "UPDATE partidas
                SET competicao_id = $competicao,
                    equipe_casa_id = $casa,
                    equipe_visitante_id = $visitante
                WHERE id = $id";

        mysqli_query($conexao, $sql);

        header("Location: partidas.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Alterar Partida</title>
</head>
<body>

<h1>Alterar Partida</h1>

<form method="POST">

    <label>Competição:</label>

    <select name="competicao" required>

        <?php

        $sqlCompeticoes = "SELECT * FROM competicoes";

        $resultadoCompeticoes = mysqli_query($conexao, $sqlCompeticoes);

        while($competicao = mysqli_fetch_assoc($resultadoCompeticoes))
        {
            $selected = "";

            if($dados['competicao_id'] == $competicao['id'])
            {
                $selected = "selected";
            }

            echo "<option value='".$competicao['id']."' $selected>";
            echo $competicao['nome'];
            echo "</option>";
        }

        ?>

    </select>

    <br><br>

    <label>Equipe Casa:</label>

    <select name="casa" required>

        <?php

        $sqlEquipes = "SELECT * FROM equipes";

        $resultadoEquipes = mysqli_query($conexao, $sqlEquipes);

        while($equipe = mysqli_fetch_assoc($resultadoEquipes))
        {
            $selected = "";

            if($dados['equipe_casa_id'] == $equipe['id'])
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

    <label>Equipe Visitante:</label>

    <select name="visitante" required>

        <?php

        $sqlEquipes = "SELECT * FROM equipes";

        $resultadoEquipes = mysqli_query($conexao, $sqlEquipes);

        while($equipe = mysqli_fetch_assoc($resultadoEquipes))
        {
            $selected = "";

            if($dados['equipe_visitante_id'] == $equipe['id'])
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

<br>

<a href="partidas.php">
    Voltar
</a>

</body>
</html>
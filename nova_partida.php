<?php
include("conexao.php");

if(isset($_POST['salvar']))
{
    $competicao = $_POST['competicao'];
    $casa = $_POST['casa'];
    $visitante = $_POST['visitante'];

    if($casa != $visitante)
    {
        $sql = "INSERT INTO partidas
                (competicao_id,
                 equipe_casa_id,
                 equipe_visitante_id)

                VALUES
                ($competicao,
                 $casa,
                 $visitante)";

        mysqli_query($conexao, $sql);

        header("Location: partidas.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nova Partida</title>
</head>
<body>

<h1>Nova Partida</h1>

<form method="POST">

    Competição:

    <select name="competicao" required>

        <option value="">Selecione</option>

        <?php

        $sql = "SELECT * FROM competicoes";

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

    Equipe Casa:

    <select name="casa" required>

        <option value="">Selecione</option>

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

    Equipe Visitante:

    <select name="visitante" required>

        <option value="">Selecione</option>

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

<a href="partidas.php">Voltar</a>

</body>
</html>
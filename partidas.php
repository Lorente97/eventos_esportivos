<?php
include("conexao.php");

if(isset($_GET['excluir']))
{
    $id = $_GET['excluir'];

    $sql = "DELETE FROM partidas
            WHERE id = $id";

    mysqli_query($conexao, $sql);
}

if(isset($_POST['salvar']))
{
    $competicao = $_POST['competicao'];
    $casa = $_POST['casa'];
    $visitante = $_POST['visitante'];

    $sql = "INSERT INTO partidas
            (competicao_id, equipe_casa_id, equipe_visitante_id)
            VALUES
            ($competicao, $casa, $visitante)";

    mysqli_query($conexao, $sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Partidas</title>
</head>
<body>

<h1>Cadastro de Partidas</h1>

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

<hr>

<h2>Partidas Registradas</h2>

<table border="1">

<tr>
    <th>ID</th>
    <th>Competição</th>
    <th>Equipe Casa</th>
    <th>Equipe Visitante</th>
    <th>Ações</th>
</tr>

<?php

$sql = "SELECT
            partidas.id,
            competicoes.nome AS competicao,
            casa.nome AS equipe_casa,
            visitante.nome AS equipe_visitante

        FROM partidas

        INNER JOIN competicoes
            ON partidas.competicao_id = competicoes.id

        INNER JOIN equipes casa
            ON partidas.equipe_casa_id = casa.id

        INNER JOIN equipes visitante
            ON partidas.equipe_visitante_id = visitante.id";

$resultado = mysqli_query($conexao, $sql);

while($linha = mysqli_fetch_assoc($resultado))
{
    echo "<tr>";

    echo "<td>".$linha['id']."</td>";

    echo "<td>".$linha['competicao']."</td>";

    echo "<td>".$linha['equipe_casa']."</td>";

    echo "<td>".$linha['equipe_visitante']."</td>";

    echo "<td>";

    echo "<a href='partidas.php?excluir=".$linha['id']."'>
    Excluir
    </a>";

    echo "</td>";

    echo "</tr>";
}

?>

</table>

<a href="index.php">Voltar</a>

</body>
</html>
<?php
include("conexao.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Partidas</title>
</head>
<body>

<h1>Partidas</h1>

<a href="nova_partida.php">
    Novo Registro
</a>

<hr>

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

    echo "<a href='alterar_partida.php?id=".$linha['id']."'>
            Editar
          </a> | ";

    echo "<a href='consultar_partida.php?id=".$linha['id']."'>
            Consultar
          </a>";

    echo "</td>";

    echo "</tr>";
}

?>

</table>

<a href="index.php">Voltar</a>

</body>
</html>
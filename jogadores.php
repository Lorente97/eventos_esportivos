<?php
include("conexao.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Jogadores</title>
</head>
<body>

<h1>Jogadores</h1>

<a href="novo_jogador.php">
    Novo Registro
</a>

<hr>

<table border="1">

<tr>
    <th>ID</th>
    <th>Jogador</th>
    <th>Equipe</th>
    <th>Ações</th>
</tr>

<?php

$sql = "SELECT jogadores.id,
               jogadores.nome,
               equipes.nome AS equipe
        FROM jogadores
        INNER JOIN equipes
        ON jogadores.equipe_id = equipes.id";

$resultado = mysqli_query($conexao, $sql);

while($linha = mysqli_fetch_assoc($resultado))
{
    echo "<tr>";

    echo "<td>".$linha['id']."</td>";

    echo "<td>".$linha['nome']."</td>";

    echo "<td>".$linha['equipe']."</td>";

    echo "<td>";

    echo "<a href='alterar_jogador.php?id=".$linha['id']."'>
            Editar
          </a> | ";

    echo "<a href='consultar_jogador.php?id=".$linha['id']."'>
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
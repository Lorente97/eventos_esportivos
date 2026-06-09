<?php
include("conexao.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Equipes</title>
</head>
<body>

<h1>Equipes</h1>

<a href="nova_equipe.php">
    Novo Registro
</a>

<hr>

<table border="1">

<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Ações</th>
</tr>

<?php

$sql = "SELECT * FROM equipes";

$resultado = mysqli_query($conexao, $sql);

while($linha = mysqli_fetch_assoc($resultado))
{
    echo "<tr>";

    echo "<td>".$linha['id']."</td>";

    echo "<td>".$linha['nome']."</td>";

    echo "<td>";

    echo "<a href='alterar_equipe.php?id=".$linha['id']."'>
            Editar
          </a> | ";

    echo "<a href='consultar_equipe.php?id=".$linha['id']."'>
            Consultar
          </a>";

    echo "</td>";

    echo "</tr>";
}

?>

</table>

<br>

<a href="index.php">Voltar</a>

</body>
</html>
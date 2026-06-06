<?php
include("conexao.php");

if(isset($_GET['excluir']))
{
    $id = $_GET['excluir'];

    $sql = "DELETE FROM competicoes
            WHERE id = $id";

    mysqli_query($conexao, $sql);
}

$nomeEditar = "";

if(isset($_GET['editar']))
{
    $idEditar = $_GET['editar'];

    $sql = "SELECT * FROM competicoes WHERE id = $idEditar";

    $resultado = mysqli_query($conexao, $sql);

    $dados = mysqli_fetch_assoc($resultado);

    $nomeEditar = $dados['nome'];
}

if(isset($_POST['atualizar']))
{
    $id = $_POST['id'];
    $nome = $_POST['nome'];

    $sql = "UPDATE competicoes
            SET nome = '$nome'
            WHERE id = $id";

    mysqli_query($conexao, $sql);
}

if(isset($_POST['salvar']))
{
    $nome = $_POST['nome'];

    $sql = "INSERT INTO competicoes(nome)
            VALUES('$nome')";

    mysqli_query($conexao, $sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Competições</title>
</head>
<body>

<h1>Cadastro de Competições</h1>

<form method="POST">

    <input
        type="hidden"
        name="id"
        value="<?php echo isset($idEditar) ? $idEditar : ''; ?>"
    >

    Nome da Competição:

    <input
        type="text"
        name="nome"
        value="<?php echo $nomeEditar; ?>"
        required
    >

    <?php
    if(isset($idEditar))
    {
        echo '<button type="submit" name="atualizar">Atualizar</button>';
    }
    else
    {
        echo '<button type="submit" name="salvar">Salvar</button>';
    }
    ?>

</form>

<hr>

<h2>Competições Cadastradas</h2>

<table border="1">

<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Ações</th>
</tr>

<?php

$sql = "SELECT * FROM competicoes";

$resultado = mysqli_query($conexao, $sql);

while($linha = mysqli_fetch_assoc($resultado))
{
    echo "<tr>";
echo "<td>".$linha['id']."</td>";
echo "<td>".$linha['nome']."</td>";
echo "<td>";

echo "<a href='competicoes.php?editar=".$linha['id']."'>
Editar
</a> | ";

echo "<a href='competicoes.php?excluir=".$linha['id']."'>
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
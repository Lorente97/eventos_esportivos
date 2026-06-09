<?php
include("conexao.php");

$id = $_GET['id'];

$sql = "SELECT * FROM equipes
        WHERE id = $id";

$resultado = mysqli_query($conexao, $sql);

$dados = mysqli_fetch_assoc($resultado);

if(isset($_POST['excluir']))
{
    $sql = "DELETE FROM equipes
            WHERE id = $id";

    mysqli_query($conexao, $sql);

    header("Location: equipes.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Consultar Equipe</title>
</head>
<body>

<h1>Consultar Equipe</h1>

<p>
    <strong>Nome:</strong>
    <?php echo $dados['nome']; ?>
</p>

<form method="POST">

    <button
        type="submit"
        name="excluir">
        Excluir
    </button>

</form>

<br>

<a href="equipes.php">
    Voltar
</a>

</body>
</html>
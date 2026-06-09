<?php
include("conexao.php");

$id = $_GET['id'];

$sql = "SELECT jogadores.nome,
               equipes.nome AS equipe
        FROM jogadores

        INNER JOIN equipes
        ON jogadores.equipe_id = equipes.id

        WHERE jogadores.id = $id";

$resultado = mysqli_query($conexao, $sql);

$dados = mysqli_fetch_assoc($resultado);

if(isset($_POST['excluir']))
{
    $sql = "DELETE FROM jogadores
            WHERE id = $id";

    mysqli_query($conexao, $sql);

    header("Location: jogadores.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Consultar Jogador</title>
</head>
<body>

<h1>Consultar Jogador</h1>

<p>
    <strong>Nome:</strong>
    <?php echo $dados['nome']; ?>
</p>

<p>
    <strong>Equipe:</strong>
    <?php echo $dados['equipe']; ?>
</p>

<form method="POST">

    <button type="submit" name="excluir">
        Excluir
    </button>

</form>

<a href="jogadores.php">
    Voltar
</a>

</body>
</html>
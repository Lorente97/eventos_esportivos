<?php
include("conexao.php");

$id = $_GET['id'];

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
            ON partidas.equipe_visitante_id = visitante.id

        WHERE partidas.id = $id";

$resultado = mysqli_query($conexao, $sql);

$dados = mysqli_fetch_assoc($resultado);

if(isset($_POST['excluir']))
{
    $sql = "DELETE FROM partidas
            WHERE id = $id";

    mysqli_query($conexao, $sql);

    header("Location: partidas.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Consultar Partida</title>
</head>
<body>

<h1>Consultar Partida</h1>

<p>
    <strong>Competição:</strong>
    <?php echo $dados['competicao']; ?>
</p>

<p>
    <strong>Equipe Casa:</strong>
    <?php echo $dados['equipe_casa']; ?>
</p>

<p>
    <strong>Equipe Visitante:</strong>
    <?php echo $dados['equipe_visitante']; ?>
</p>

<form method="POST">

    <button type="submit" name="excluir">
        Excluir
    </button>

</form>

<a href="partidas.php">Voltar</a>

</body>
</html>
<?php
include("conexao.php");

$id = $_GET['id'];

$sql = "SELECT * FROM equipes
        WHERE id = $id";

$resultado = mysqli_query($conexao, $sql);

$dados = mysqli_fetch_assoc($resultado);

if(isset($_POST['atualizar']))
{
    $nome = $_POST['nome'];

    $sql = "UPDATE equipes
            SET nome = '$nome'
            WHERE id = $id";

    mysqli_query($conexao, $sql);

    header("Location: equipes.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Alterar Equipe</title>
</head>
<body>

<h1>Alterar Equipe</h1>

<form method="POST">

    Nome:

    <input
        type="text"
        name="nome"
        value="<?php echo $dados['nome']; ?>"
        required
    >

    <br><br>

    <button
        type="submit"
        name="atualizar">
        Atualizar
    </button>

</form>

<br>

<a href="equipes.php">
    Voltar
</a>

</body>
</html>
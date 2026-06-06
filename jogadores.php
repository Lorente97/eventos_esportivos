<?php
include("conexao.php");

if(isset($_GET['excluir']))
{
    $id = $_GET['excluir'];

    $sql = "DELETE FROM jogadores
            WHERE id = $id";

    mysqli_query($conexao, $sql);
}

$nomeEditar = "";
$equipeEditar = "";

if(isset($_GET['editar']))
{
    $idEditar = $_GET['editar'];

    $sql = "SELECT * FROM jogadores
            WHERE id = $idEditar";

    $resultado = mysqli_query($conexao, $sql);

    $dados = mysqli_fetch_assoc($resultado);

    $nomeEditar = $dados['nome'];
    $equipeEditar = $dados['equipe_id'];
}

if(isset($_POST['atualizar']))
{
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $equipe = $_POST['equipe'];

    $sql = "UPDATE jogadores
            SET nome = '$nome',
                equipe_id = $equipe
            WHERE id = $id";

    mysqli_query($conexao, $sql);
}

if(isset($_POST['salvar']))
{
    $nome = $_POST['nome'];
    $equipe = $_POST['equipe'];

    $sql = "INSERT INTO jogadores(nome, equipe_id)
            VALUES('$nome', $equipe)";

    mysqli_query($conexao, $sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Jogadores</title>
</head>
<body>

<h1>Cadastro de Jogadores</h1>

<form method="POST">

    <input
        type="hidden"
        name="id"
        value="<?php echo isset($idEditar) ? $idEditar : ''; ?>"
    >

    Nome:

    <input
        type="text"
        name="nome"
        value="<?php echo $nomeEditar; ?>"
        required
    >

    Equipe:

    <select name="equipe" required>

        <option value="">
            Selecione
        </option>

        <?php

        $sqlEquipe = "SELECT * FROM equipes";

        $resultadoEquipe = mysqli_query($conexao, $sqlEquipe);
        
        echo "Quantidade: " . mysqli_num_rows($resultadoEquipe);

        while($equipe = mysqli_fetch_assoc($resultadoEquipe))
        {
            $selected = "";

            if($equipeEditar == $equipe['id'])
            {
                $selected = "selected";
            }

            echo "<option value='".$equipe['id']."' $selected>";

            echo $equipe['nome'];

            echo "</option>";
        }

        ?>

    </select>

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

<h2>Jogadores Cadastrados</h2>

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

    echo "<a href='jogadores.php?editar=".$linha['id']."'>
    Editar
    </a> | ";

    echo "<a href='jogadores.php?excluir=".$linha['id']."'>
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
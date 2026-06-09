<?php

$conexao = mysqli_connect(
    "localhost",
    "root",
    "",
    "eventos_esportivos",
    3307
);

if(!$conexao)
{
    die("Erro na conexão: " . mysqli_connect_error());
}

?>
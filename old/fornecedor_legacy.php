<?php

$mysqli = new mysqli("localhost", "root", "123456", "legacy_db");

if ($mysqli->connect_error) {
  die("Erro ao conectar: " . $mysqli->connect_error);
}

$action = $_GET["action"] ?? "list";

function onlyDigits($x)
{
  return preg_replace('/\D/', '', $x);
}

if ($action === "create") {
  $nome  = $_POST["nome"]  ?? "";
  $cnpj  = onlyDigits($_POST["cnpj"] ?? "");
  $email = $_POST["email"] ?? "";

  if (strlen($nome) < 3) {
    die("Nome muito curto");
  }

  if (strlen($cnpj) != 14) {
    die("CNPJ inválido");
  }

  $sql = "INSERT INTO fornecedores (nome, cnpj, email, criado_em) 
            VALUES ('$nome', '$cnpj', '$email', NOW())";

  if (!$mysqli->query($sql)) {
    die("Erro ao inserir: " . $mysqli->error);
  }

  echo "OK";
} else {
  $q = $_GET["q"] ?? "";

  $sql = "SELECT id, nome, cnpj, email, criado_em 
            FROM fornecedores 
            WHERE nome LIKE '%$q%' 
            ORDER BY criado_em DESC 
            LIMIT 50";

  $res   = $mysqli->query($sql);
  $data  = [];

  while ($row = $res->fetch_assoc()) {
    $data[] = $row;
  }

  header("Content-Type: application/json");
  echo json_encode($data);
}

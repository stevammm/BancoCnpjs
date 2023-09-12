<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conectar com o Banco:
$mysqli = new mysqli("localhost", "root", 'usbw', "", 3306);

// Comando para criar o banco de dados "cnpjs"
$comandoCreateDB = "CREATE DATABASE IF NOT EXISTS cnpjs;";
if ($mysqli->query($comandoCreateDB) === TRUE) {
    echo "Banco de dados 'cnpjs' criado com sucesso.<br>";
} else {
    echo "Erro ao criar o banco de dados: " . $mysqli->error . "<br>";
}

// Comando para selecionar o banco de dados "cnpjs"
$comandoUseDB = "USE cnpjs;";
if ($mysqli->query($comandoUseDB) === TRUE) {
    echo "Banco de dados 'cnpjs' selecionado com sucesso.<br>";
} else {
    echo "Erro ao selecionar o banco de dados: " . $mysqli->error . "<br>";
}

// Comando para criar a cnpjs "usuarios"
$comandoCreateTable = "CREATE TABLE IF NOT EXISTS usuarios (
    id int(11) unsigned NOT NULL auto_increment,
    c1 varchar(250) default NULL,
    c2 varchar(250) default NULL,
    c3 varchar(250) default NULL,
    c4 varchar(250) default NULL,
    c5 varchar(250) default NULL,
    c6 varchar(250) default NULL,
    c7 varchar(250) default NULL,
    
    PRIMARY KEY  (`id`)
) ENGINE = MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

if ($mysqli->query($comandoCreateTable) === TRUE) {
    echo "Tabela 'usuarios' criada com sucesso.<br>";
} else {
    echo "Erro ao criar a tabela 'usuarios': " . $mysqli->error . "<br>";
}

$folderName = "cnpjs/";
$conteudo = dir($folderName);
ini_set('max_execution_time', 0);
echo "Lista de Arquivos do diretório '<strong>" . "cnpjs/" . "</strong>':<br />";
$conta = 0;
while ($arquivo1 = $conteudo->read()) {
    if (substr($arquivo1, 0, 1) != ".") {
        echo $arquivo1 . "<br>";
        $arquivo2 = fopen($folderName . $arquivo1, "r");
        $linha = fgets($arquivo2);
        while ($linha) {
            $linhaCompleta = explode(";", $linha);
            $vQuery = "INSERT INTO usuarios(
                c1,
                c2,
                c3,
                c4,
                c5,
                c6,
                c7
            ) VALUES (
                '" . str_replace("'", "", $linhaCompleta[0]) . "',
                '" . str_replace("'", "", $linhaCompleta[1]) . "',
                '" . str_replace("'", "", $linhaCompleta[2]) . "',
                '" . str_replace("'", "", $linhaCompleta[3]) . "',
                '" . str_replace("'", "", $linhaCompleta[4]) . "',
                '" . str_replace("'", "", $linhaCompleta[5]) . "',
                '" . str_replace("'", "", $linhaCompleta[6]) . "'
            );";
            if ($mysqli->query($vQuery) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $vQuery . "<br>" . $mysqli->error;
            }
            echo "<br>" . $conta . " " . $vQuery . "<br>";
            $linha = fgets($arquivo2);
            $conta++;
        }
    }
}
?>
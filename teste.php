<?php
$__CONEXAO__ = mysqli_connect(
    "localhost",
    "root",
    "Bancodedados",
    "teste"
) or die ("Atualize a página e tente novamente!");

for($i = 0; $i < 99999999; $i++){
    $_query_ = mysqli_query($__CONEXAO__, "update prod set qnt = qnt - 1, version = version + 1 where id='1' and qnt > 0");
}

echo "done";
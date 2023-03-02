<?php
require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'delete'){
    parse_str(file_get_contents('php://input'), $input);

    $id = filter_var((!empty($input['id'])) ? $input['id'] : null);

    if($id){
        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $sql = $pdo->prepare("DELETE FROM notes WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();

            
            $array['result'][] = [
                'excluido com sucesso'];
        }
        else{
            $array['error'] = 'ID inexistente.';
        }
    }
    else{
        $array['error'] = 'ID não enviado.';
    }
}
else{
    $array['error'] = 'Método não permitido (apenas DELETE)';
}

require('return.php');

?>
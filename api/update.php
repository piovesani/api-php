<?php
require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'put'){
    parse_str(file_get_contents('php://input'), $input);

    $id = filter_var((!empty($input['id'])) ? $input['id'] : null);
    $title = filter_var((!empty($input['title'])) ? $input['title'] : null);
    $body = filter_var((!empty($input['body'])) ? $input['body'] : null);

    if($id && $title && $body){
        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $sql = $pdo->prepare("UPDATE notes SET title = :title, body = :body WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->bindValue(':title', $title);
            $sql->bindValue(':body', $body);
            $sql->execute();

            $data = $sql->fetch(PDO::FETCH_ASSOC);
    
            $array['result'][] = [
                'id' => $id,
                'title' => $title,
                'body' => $body
            ];
        }
        else{
            $array['error'] = 'ID inexistente.';
        }
    }
    else{
        $array['error'] = 'Preencher todos os campos.';
    }
}
else{
    $array['error'] = 'Método não permitido (apenas PUT)';
}

require('return.php');

?>
<?php

require_once 'config.php';

class CommentsModel {
    private $db;
    //CONEXIÓN CON LA BDD
    function __construct(){
        $this->db = new PDO("mysql:host=" . HOST . ";dbname=" . NAME, USER, PASSWORD);
    }
    // OBTENGO TODOS LOS COMENTARIOS DE TODOS LOS PRODUCTOS
    function GetComments(){
        $sentencia = $this->db->prepare("SELECT * FROM comentario");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    // OBTENGO COMENTARIOS ORDENADOS POR UN CAMPO Y EN FORMA ASCENDENTE O DESCENDENTE
    // function GetCommentsOS($order, $sort){
    //     $sentencia = $this->db->prepare("SELECT * FROM comentario ORDER BY $order $sort");
    //     $sentencia->execute();
    //     return $sentencia->fetchAll(PDO::FETCH_OBJ);
    // }
    // BUSCO COMENTARIOS POR ID
    function GetCommentById($comment_id){
        $sentencia = $this->db->prepare("SELECT * FROM comentario WHERE id_comentario=?");
        $sentencia->execute(array($comment_id));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    // BUSCO COMENTARIOS POR PRODUCTO
    function GetCommentsByProduct($product_id){
        $sentencia = $this->db->prepare('SELECT * FROM comentario c WHERE c.id_producto = ? ORDER BY id_comentario ASC');
        $sentencia->execute(array($product_id));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    // INSERTO COMENTARIO
    function InsertComment($description, $score, $product_id){
        $sentencia = $this->db->prepare("INSERT INTO comentario(descripcion, valoracion, product_id) VALUES(?,?,?,?)");
        $sentencia->execute(array($description, $score, $product_id));
    }
    // ACTUALIZO COMENTARIO
    function UpdateComment($comment_id, $description, $score){
        $sentencia = $this->db->prepare("UPDATE comentario SET descripcion=?, valoracion=? WHERE id_comentario=?");
        $sentencia->execute(array($description, $score, $comment_id));
    }
    //ELIMINO COMENTARIO
    function DeleteComment($comment_id){
        $sentencia = $this->db->prepare("DELETE FROM comentario WHERE id_comentario=?");
        $sentencia->execute(array($comment_id));
    }
}

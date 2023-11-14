<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/helpers/auth.api.helper.php';
require_once 'app/models/comments.model.php';

class CommentsController extends ApiController {
    private $authHelper;
    private $model;

    function __construct() {
        parent::__construct();
        $this->authHelper = new authHelper();
        $this->model = new CommentsModel();
    }

    function GetComments($params = []) {
        if (empty($params)) {
            $this->view->response($this->model->GetComments(), 200);
            return;
        } else {
            $comentarios = $this->model->GetCommentsByProduct($params[':ID']);
            if (!empty($comentarios)) {
                    $this->view->response($comentarios, 200);
                    return;
            } else {
                $this->view->response('No hay comentarios asociados al producto con el id ' . $params[':ID'], 404);
                return;
            }
        }
    }

    function GetCommentsOS($params = []) {
        if (empty($params)) {
            $this->view->response('Indique los parámetros Order y Sort', 404);
            return;
        } else {
            $comentarios = $this->model->GetCommentsOS($params[':ORDER'],$params[':SORT']);
            if (!empty($comentarios)) {
                    $this->view->response($comentarios, 200);
                    return;
            } else {
                $this->view->response('No hay comentarios', 404);
                return;
            }
        }
    }

    // function GetCommentsOS($params = []) {
    //     $sort = 'id_comentario';
    //     $order = 'asc';
    //     if ($params[':ORDER']) {
    //         $order = $params[':ORDER'];
    //         if ($order != 'asc' && $order != 'desc') {
    //             $order = 'asc';
    //         }
    //     }
    //     if ($params[':SORT']) {
    //         $sort = $params[':SORT'];
    //         $columnasComentario = array('id_comentario', 'descripcion','valoracion','id_producto');
    //         if (!in_array($sort, $columnasComentario)) {
    //             $sort = 'id_comentario';
    //         }
    //     }
    //     $comentarios = $this->model->GetComments($order, $sort);
    //     $this->view->response($comentarios, 200);
    //     return;
    // }


    function InsertComment($params = []) {
        $user = $this->authHelper->currentUser();
        if (!$user) {
            $this->view->response('Unauthorized', 401);
            return;
        }
        $body = $this->getData();
        $description = $body->description;
        $score = $body->score;
        $product_id = $body->product_id;
        $id = $this->model->InsertComment($description, $score, $product_id);
        $this->view->response('Se insertó el comentario con el id' . $id, 201);
        return;
    }

    function UpdateComment($params = []) {
        $user = $this->authHelper->currentUser();
        if (!$user) {
            $this->view->response('Unauthorized', 401);
            return;
        }
        $id = $params[':ID'];
        $comentario = $this->model->GetCommentById($id);
        if ($comentario) {
            $body = $this->getData();
            $description = $body->description;
            $score = $body->score;
            $this->model->UpdateComment($id, $description, $score);
            $this->view->response('Se modificó el comentario con el id ' . $id, 200);
            return;
        } else {
            $this->view->response('No existe el comentario con el id ' . $id, 404);
            return;
        }
    }

    function DeleteComment($params = []) {
        $user = $this->authHelper->currentUser();
        if (!$user) {
            $this->view->response('Unauthorized', 401);
            return;
        }
        $id = $params[':ID'];
        $comentario = $this->model->GetCommentById($id);
        if ($comentario) {
            $this->model->DeleteComment($id);
            $this->view->response('Se eliminó el comentario con el id ' . $id, 200);
            return;
        } else {
            $this->view->response('No existe el comentario con el id ' . $id, 404);
            return;
        }
    }

}


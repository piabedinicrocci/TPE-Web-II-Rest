<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/helpers/auth.api.helper.php';
require_once 'app/models/categories.model.php';

class CategoriesController extends ApiController {
    private $authHelper;
    private $model;

    function __construct() {
        parent::__construct();
        $this->authHelper = new authHelper();
        $this->model = new CategoriesModel();
    }

    function GetCategories($params = []) {
        if (empty($params)) {
            $categorias = $this->model->GetCategories();
            $this->view->response($categorias, 200);
            return;
        } else {
            $categoria = $this->model->GetCategoryById($params[':ID']);
            if (!empty($categoria)) {
                $this->view->response($categoria, 200);
                return;
            } else {
                $this->view->response('No existe la categoría con el id ' . $params[':ID'],404);
                return;
            }
        }
    }

    function InsertCategory($params = []) {
        $user = $this->authHelper->currentUser();
        if (!$user) {
            $this->view->response('Unauthorized', 401);
            return;
        }
        $body = $this->getData();
        $nombre_categoria = $body->nombre_categoria;
        $id = $this->model->InsertCategory($nombre_categoria);

        $this->view->response('Se insertó la categoría con el id ' . $id, 201);
        return;
    }

    function UpdateCategory($params = []) {
        $user = $this->authHelper->currentUser();
        if (!$user) {
            $this->view->response('Unauthorized', 401);
            return;
        }
        $id = $params[':ID'];
        $categoria = $this->model->GetCategoryById($id);
        if ($categoria) {
            $body = $this->getData();
            $nombre_categoria = $body->nombre_categoria;
            $this->model->UpdateCategory($nombre_categoria, $id);
            $this->view->response('Se modificó el género con el id ' . $id, 200);
            return;
        } else {
            $this->view->response('No existe la categoría con el id ' . $id, 404);
            return;
        }
    }

    function DeleteCategory($params = []) {
        $user = $this->authHelper->currentUser();
        if (!$user) {
            $this->view->response('Unauthorized', 401);
            return;
        }
        $id = $params[':ID'];
        $categoria = $this->model->GetCategoryById($id);
        if ($categoria) {
            $this->model->DeleteCategory($id);
            $this->view->response('Se eliminó el género con el id ' . $id, 200);
        }else{
            $this->view->response('Unauthorized', 401);
        }
    }

}
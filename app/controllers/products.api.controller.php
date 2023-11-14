<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/helpers/auth.api.helper.php';
require_once 'app/models/products.model.php';

class ProductsController extends ApiController{
    private $authHelper;
    private $model;

    function __construct() {
        parent::__construct();
        $this->authHelper = new AuthHelper();
        $this->model = new ProductsModel();
    }

    function GetProducts($params = []) {
        if (empty($params)) {
            $productos = $this->model->GetProducts();
            $this->view->response($productos, 200);
            return;
        } else {
            $producto = $this->model->GetProductById($params[':ID']);
            if (!empty($producto)) {
                $this->view->response($producto, 200);
                return;
            } else {
                $this->view->response('No existe el producto con el id ' . $params[':ID'], 404);
                return;
            }
        }
    }

    function InsertProduct($params = []) {
        $user = $this->authHelper->currentUser();
        if (!$user) {
            $this->view->response('Unauthorized', 401);
            return;
        }
        $body = $this->getData();
        $product = $body->product;
        $description = $body->description;
        $material = $body->material;
        $price = $body->price;
        $stock = $body->stock;
        $category = $body->category;
        $id = $this->model->InsertProduct($product, $description, $material, $price, $stock, $category);
        $this->view->response('Se insertó el producto con el id ' . $id, 201);
        return;
    }

    function UpdateProduct($params = []) {
        $user = $this->authHelper->currentUser();
        if (!$user) {
            $this->view->response('Unauthorized', 401);
            return;
        }
        $id = $params[':ID'];
        $producto = $this->model->GetProductById($id);
        if ($producto) {
            $body = $this->getData();
            $product = $body->product;
            $description = $body->description;
            $material = $body->material;
            $price = $body->price;
            $stock = $body->stock;
            $category = $body->category;
            $this->model->UpdateProduct($product, $description, $material, $price, $stock, $category, $id);
            $this->view->response('Se modificó el producto con el id ' . $id, 200);
            return;
        } else {
            $this->view->response('No existe el producto con el id ' . $id, 404);
            return;
        }
    }

    function DeleteProduct($params = []) {
        $user = $this->authHelper->currentUser();
        if (!$user) {
            $this->view->response('Unauthorized', 401);
            return;
        }
        $id = $params[':ID'];
        $categoria = $this->model->GetProductById($id);
        if ($categoria) {
            $this->model->DeleteProduct($id);
            $this->view->response('Se eliminó el género con el id ' . $id, 200);
        }else{
            $this->view->response('Unauthorized', 401);
        }
    }

}

<?php

use Phalcon\Mvc\Controller;

class ProductController extends Controller
{
    public function indexAction()
    {
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
    }


    public function addAction()
    {
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // $this->view->post=$_POST;

    }
    public function addhelperAction()
    {

        $data = new Products();
        $values = $_POST;
        $value = $_POST;
        $eventmanager = $this->di->get('eventManager');
        $settings = Settings::find();
        $array = $eventmanager->fire('notifications:beforeSend', (object)$value, $settings);
        echo "<pre>";
        print_r($values);
        echo "</pre>";
        die();
        $val = array(
            'name' => $array->name,
            'description' => $array->description,
            'price' => $array->price,
            'tags' => $array->tags,
            'stock' => $array->stock
        );
        $data->assign(
            $val,
            [
                'name',
                'description',
                'price',
                'tags',
                'stock',
            ]
        );
        $this->session->set('msg', "Product added successfully");
        $data->save();
        header('location:http://localhost:8080/product');
    }

    
}

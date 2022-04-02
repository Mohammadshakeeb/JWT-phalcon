<?php

namespace App\console;

use DateTime;
use Phalcon\Cli\Task;
use Phalcon\Security\JWT\Builder;
use Phalcon\Security\JWT\Signer\Hmac;
use Phalcon\Security\JWT\Token\Parser;
use Phalcon\Security\JWT\Validator;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Products;
use Settings;


class MainTask extends Task
{
    public function mainAction()
    {
        echo 'This is the default task and the default action' . PHP_EOL;
    }

    public function createTokenAction()
    {

        $key = "example_key";
        $payload = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => 1356999524,
            "nbf" => 1357000000,
            "role" => "Admin"
        );
        $jwt = JWT::encode($payload, $key, 'HS256');
        echo $jwt  . PHP_EOL;
    }

    public function defaultpriceAction($price)
    {

        $id = 1;
        $data = Settings::find(

            [
                'conditions' => 'id=:id:',
                'bind' => [
                    'id' => $id,
                ]

            ]
        );
        // echo $data[0]->default_zipcode;
        // die();
        if ($data) {
            // $data[0]->title_op = $_POST['title_op'];
            $data[0]->default_price = $price;
           
            $data[0]->save();
            
            echo $price . PHP_EOL;
        }
    }

    public function getstockAction()
    {

        $robots = Products::query()
            // ->where('type = :type:')
            ->Where('stock < 10')
            // ->bind(['type' => 'mechanical'])
            // ->order('name')
            ->execute();

            foreach($robots as $k=>$v){
                echo $v->name." ";
                echo $v->description. " ";
                echo $v->stock. " ";
                echo $v->price." ";
                echo $v->tags. " ". PHP_EOL;
                

            }
    }

    public function delaclAction(){

        unlink(APP_PATH. '/security/del.cache');
        echo "file delected". PHP_EOL;
    }

    public function getorderAction(){

        $date=date("Y/m/d");

        $robots = Products::query()
        // ->where('type = :type:')
        ->Where('data = date("Y/m/d")')
        // ->bind(['type' => 'mechanical'])
        // ->order('name')
        ->execute();
        echo $date;

        foreach($robots as $k=>$v){
            echo $v->name." ";
            echo $v->description. " ";
            echo $v->stock. " ";
            echo $v->price." ";
            echo $v->tags. " ". PHP_EOL;
        }
    }
}

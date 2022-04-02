<?php

namespace App\Listeners;

use Phalcon\Events\Event;
use Phalcon\Security\JWT\Builder;
use Phalcon\Security\JWT\Signer\Hmac;
use Phalcon\Security\JWT\Token\Parser;
use Phalcon\Security\JWT\Validator;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class notificationListeners
{

    public function beforeSend(Event $event, $values, $settings)
    {

        // echo "<pre>";
        // print_r($settings[0]->title_op);
        // print_r($values);
        // echo "</pre>";
        // die();
        if ($settings[0]->title_op == "with") {
            $values->name = $values->name . $values->tags;
        }
        if ($values->price == '') {
            $values->price = $settings[0]->default_price;
        }
        if ($values->stock == '') {
            $values->stock = $settings[0]->default_stock;
        }
        return $values;
    }

    public function afterSend(Event $event, $values, $settings)
    {
        if ($values->zipcode == '') {
            $values->zipcode = $settings[0]->default_zipcode;
        }
        return $values;
    }

    // public function beforeHandleRequest(Event $event, \Phalcon\Mvc\Application $application)
    // {
    //     // echo "hii";
    //     // die;

    //     $aclfile = APP_PATH . '/security/acl.cache';
    //     if (is_file($aclfile) == true) {

    //         $acl = unserialize(
    //             file_get_contents($aclfile)
    //         );


    //         $bearer = $application->request->get('bearer');
    //         if ($bearer) {

    //             try {
    //                 // echo "hii";
    //                 //   die;
    //                 // $parser = new Parser();
    //                 // $tokenObject = $parser->parse($bearer);
    //                 // $now = new \DateTimeImmutable();
    //                 // $expire = $now->getTimestamp();
    //                 // // $expire=$now->modify('+1 day')->getTimestamp();
    //                 // $validator = new Validator($tokenObject, 100);
    //                 // $validator -> validateExpiration($expire);
    //                 // $claims = $tokenObject->getClaims()->getPayload();
    //                 // $role = $claims['sub'];
    //                 // echo $role;
    //                 // die;
    //                // $role = $application->request->get('role');
    //                $key = "example_key";
    //                $decoded = JWT::decode($bearer, new Key($key, 'HS256'));
    //                $role= $decoded->role;
    //                 $controller = $application->router->getControllerName();
    //                 $action = $application->router->getActionName();
    //                 if (!$role || true !== $acl->isAllowed($role, $controller, $action)) {
    //                     echo "access denied";
    //                     die();
    //                 }
    //             } catch (\Exception $e) {
    //                 $e->getMessage();
    //                 die;
    //             }
    //         } else {
    //             echo "token not provided";
    //             die;
    //         }
    //     } else {

    //         echo "No ACL";
    //         die();
    //     }
    // }
}

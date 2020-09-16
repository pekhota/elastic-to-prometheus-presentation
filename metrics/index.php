<?php

require_once __DIR__.'/bootstrap.php';

$t = new ElasticSearchOperations($client, 'my_index2', $spanExample);

$requestUri = $_SERVER['REQUEST_URI'];

switch ($requestUri) {
    case '/createIndex':
        if(!$t->isIndexExist()) {
            $t->createIndex();
            echo "Index created";
        } else {
            echo "Index already exist";
        }
        break;
    case '/pushMetric':
//        if(!$t->isIndexExist()) {
//            echo "Index is not exist";
//        }
        $r= $t->insertRecord();
        dd($r);
        break;
    default:
        require_once __DIR__.'/main.php';
        break;
}

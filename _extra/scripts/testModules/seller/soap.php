<?php
require __DIR__.'/../_tools/init.php';

// Initialize the client
$client = new \SmileCoreTest\SoapClient();
$client->setDebug(true);
$client->setMagentoParams($params);
$client->addService('trainingSellerSellerRepositoryV1');

$object=[
    'seller' => [
        'identifier' => 'test',
        'name'       => 'my seller',
        'description'=> 'ma description'
    ]
];
$search = [
    'searchCriteria' => [
        'filterGroups' => [
            [
                'filters' => [
                    [
                        'field'          =>'identifier',
                        'conditionType' => 'like',
                        'value'          => '%es%'
                    ]
                ]
            ]
        ]
    ]
];

$client->trainingSellerSellerRepositoryV1Save($object);
$client->trainingSellerSellerRepositoryV1GetByIdentifier(['identifier' => 'test']);
$client->trainingSellerSellerRepositoryV1DeleteByIdentifier(['identifier' => 'test']);

$ps = $client->trainingSellerSellerRepositoryV1Save($object);
$client->trainingSellerSellerRepositoryV1GetById(['sellerId' => $ps->sellerId]);
$client->trainingSellerSellerRepositoryV1GetList($search);
$client->trainingSellerSellerRepositoryV1DeleteById(['sellerId' => $ps->sellerId]);




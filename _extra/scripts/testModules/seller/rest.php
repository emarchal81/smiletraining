<?php
require __DIR__.'/../_tools/init.php';

// Initialize the client
$client = new \SmileCoreTest\RestClient();
$client->setDebug(true);
$client->setMagentoParams($params);
$client->connect();

$object=[
    'seller' => [
        'identifier' => 'test',
        'name'       => 'my seller',
        'description'=> 'test',
    ]
];
$search = [
    'searchCriteria' => [
        'filterGroups' => [
            [
                'filters' => [
                    [
                        'field'          =>'identifier',
                        'condition_type' => 'like',
                        'value'          => '%es%'
                    ]
                ]
            ]
        ]
    ]
];

$client->post('rest/V1/seller/',$object);
$client->get('rest/V1/seller/identifier/'.$object['seller']['identifier']);
$client->delete('rest/V1/seller/identifier/'.$object['seller']['identifier']);

$ps = $client->post('rest/V1/seller/',$object);
$client->get('rest/V1/seller/id/'.$ps['seller_id']);
$client->get('rest/V1/seller?'.http_build_query($search));
$client->delete('rest/V1/seller/id/'.$ps['seller_id']);

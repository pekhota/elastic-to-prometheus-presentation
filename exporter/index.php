<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use Elasticsearch\ClientBuilder;
use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\InMemory;

require_once __DIR__.'/vendor/autoload.php';

$builder = ClientBuilder::create();
$builder->setHosts(["http://elasticsearch:9200"]);
$client = $builder->build();

try {
    $client->info();
} catch (Elasticsearch\Common\Exceptions\NoNodesAvailableException $e) {
    echo "Elastic not found";
    die();
}


$res = $client->search([
    'index' => 'my_index2',
    'body' => [
        'size' =>  0,
        'query' => [
            'bool' => [
                'filter' => [
                    [
                        'term' => [
                            'operationName' => 'publicLink'
                        ]
                    ],
                    [
                        'range' => [
                            'startTimeMillis' => [
                                'gte' => 'now-5m',
                                'lte' => 'now',
                                'format' => 'epoch_millis'
                            ]
                        ]
                    ]
                ]
            ]
        ],
        'aggs' => [
            'operation' => [
                'terms' => [
                    'field' => 'operationName'
                ],
                'aggs' => [
                    'p' => [
                        'percentiles' => [
                            'field' => 'duration',
                            'percents' => [
                                25,
                                50,
                                75,
                                95,
                                99
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
]);

$values = \IlluminateAgnostic\Arr\Support\Arr::get($res, 'aggregations.operation.buckets.0.p.values');

$registry = new CollectorRegistry(new InMemory());

$gauge = $registry->getOrRegisterGauge('opentracing', 'top_level_link_duration', 'Very useful metric', ['percentile']);

if(!empty($values)) {
    foreach ($values as $p => $v) {
        $gauge->set($v, [$p]);
    }
}

$renderer = new RenderTextFormat();
$result = $renderer->render($registry->getMetricFamilySamples());

header('Content-type: ' . RenderTextFormat::MIME_TYPE);
echo $result;




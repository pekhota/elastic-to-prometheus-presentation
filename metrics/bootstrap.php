<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);

use Elasticsearch\ClientBuilder;

require_once __DIR__ . '/vendor/autoload.php';

$builder = ClientBuilder::create();
$builder->setHosts(["http://elasticsearch:9200"]);
$client = $builder->build();

$spanExample = json_decode(file_get_contents(__DIR__ . '/example.json'), true);

class ElasticSearchOperations {
    protected \Elasticsearch\Client $client;
    protected string $index;
    protected array $span;

    /**
     * ElasticSearchOperations constructor.
     * @param \Elasticsearch\Client $client
     * @param string $index
     */
    public function __construct(\Elasticsearch\Client $client, string $index, array $span)
    {
        $this->client = $client;
        $this->index = $index;
        $this->span = $span;
    }

    public function isIndexExist() {
        $params['index'] = $this->index;

        try {
            $this->client->indices()->getSettings($params);
            return true;
        } catch (Elasticsearch\Common\Exceptions\Missing404Exception $e) {
            return false;
        }
    }

    /**
     * @param \Elasticsearch\Client $client
     * @return array
     */
    public function createIndex()
    {
        $params = [
            'index' => $this->index,
            'body' => [
                'mappings' => [
                    "span" => [
                        '_source' => array(
                            'enabled' => true
                        ),
                        "properties" => [
                            "startTimeMillis" => [
                                "type" => "date",
                                "format" => "epoch_millis"
                            ],
                            "operationName" => [
                                "type" => "keyword",
                                "ignore_above" => 256
                            ]
                        ]
                    ]
                ]
            ]
        ];

        return $this->client->indices()->create($params);
    }

    public function insertRecord()
    {
        $spanExample = $this->span;

        $spanExample['traceID'] = uniqid();
        $spanExample['spanID'] = uniqid();

        $time = time();
        $spanExample['startTime'] = $time * 1000 * 1000;
        $spanExample['startTimeMillis'] = $time * 1000;
        $spanExample['duration'] = rand(1, 100) * 10 * 1000;

        $params = [
            'index' => $this->index,
            'type' => 'span',
            'id' => uniqid("", true),
            'body' => $spanExample
        ];

        $response = $this->client->index($params);
        return $response;
    }
}

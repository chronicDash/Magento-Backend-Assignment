<?php
namespace Yash\US1;

use Yash\US1\Api\Interfaces\MyCustomInterface;
use Yash\US1\Logger\Logger;

class Test
{
    protected $category;
    protected $data;
    protected $info;
    protected $logger;

    public function __construct(
        MyCustomInterface $category,
        Logger $logger,
        array $data = [],
        string $info = ''
    ) {
        if (!$category instanceof MyCustomInterface) {
            throw new \InvalidArgumentException('Invalid category interface injected.');
        }

        $this->category = $category;
        $this->data = $data;
        $this->info = $info;
        $this->logger = $logger;
    }

    public function displayParams()
    {
        $jsonData = json_encode($this->data, JSON_PRETTY_PRINT);
        $this->logger->info("Logging Params: " . $jsonData);
        return "Params logged successfully.\nInfo: " . $this->info;
    }
}
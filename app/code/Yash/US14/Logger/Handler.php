<?php
namespace Yash\US14\Logger;

use Magento\Framework\Logger\Handler\Base;

class Handler extends Base
{
    protected $loggerType = Logger::DEBUG;
    protected $fileName = "/var/log/example.log";
}

<?php
namespace Yash\US1\Logger;

class Handler extends \Magento\Framework\Logger\Handler\Base
{
    protected $loggerType = Logger::DEBUG;
    protected $fileName = '/var/log/myLog.log';
}

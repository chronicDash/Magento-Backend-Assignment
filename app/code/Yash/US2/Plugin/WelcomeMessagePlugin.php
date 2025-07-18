<?php
namespace Yash\US2\Plugin;

class WelcomeMessagePlugin
{
    public function afterGetWelcome($subject, $result)
    {
        return "Welcome to Hummingbird Store";   
    }
}

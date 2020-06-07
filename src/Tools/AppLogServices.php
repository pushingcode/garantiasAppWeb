<?php

declare(strict_types = 1);

namespace App\Tools;
use Monolog\Logger;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\StreamHandler;

class AppLogServices
{

    public static function servicesLog($lvl,$message, array $context): void
    {
        switch ($lvl) {
            case 100:
                $level = "debug";
                $n_level = 100;
                break;
            case 200:
                $level = "info";
                $n_level = 200;
                break;
            case 250:
                $level = "notice";
                $n_level = 250;
                break;
            case 300:
                $level = "warning";
                $n_level = 300;
                break;
            case 400:
                $level = "error";
                $n_level = 400;
                break;
            case 500:
                $level = "critical";
                $n_level = 500;
                break;
            case 550:
                $level = "alert";
                $n_level = 550;
                break;
            case 600:
                $level = "emergency";
                $n_level = 600;
                break;
            default:
                $level = "info";
                $n_level = 200;
                break;
        }
        $logger = new Logger("AppServices");

        $logger->pushHandler(new StreamHandler(__DIR__ . '/../../var/log'.'/services.log', $n_level));
        $logger->pushHandler(new FirePHPHandler());
        
        $logger->{$level}($message, $context);
    }
}
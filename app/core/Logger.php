<?php

class Logger
{
    private static $logFile;

    public static function init()
    {
        if (!self::$logFile) {
            $logDir = dirname(__DIR__) . '/storage/logs';
            if (!is_dir($logDir)) {
                mkdir($logDir, 0777, true);
            }
            self::$logFile = $logDir . '/app-' . date('Y-m-d') . '.log';
        }
    }

    public static function log($message, $level = 'INFO')
    {
        self::init();
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[{$timestamp}] [{$level}] {$message}" . PHP_EOL;
        file_put_contents(self::$logFile, $logMessage, FILE_APPEND);
    }

    public static function info($message)
    {
        self::log($message, 'INFO');
    }

    public static function error($message)
    {
        self::log($message, 'ERROR');
    }

    public static function debug($message)
    {
        self::log($message, 'DEBUG');
    }

    public static function warning($message)
    {
        self::log($message, 'WARNING');
    }
}

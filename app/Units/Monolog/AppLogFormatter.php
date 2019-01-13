<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-13 18:18
 */

namespace App\Units\Monolog;


class AppLogFormatter
{
    /**
     * Customize the given logger instance.
     *
     * @param  \Illuminate\Log\Logger  $logger
     * @return void
     */
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(new Formatter());
        }
    }

}
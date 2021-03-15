<?php

namespace denis909\yii;

use Psr\Log\NullLogger;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerAwareInterface;
use Denis909\ConsoleLogger\ConsoleLogger;

class ConsoleController extends \yii\console\Controller implements LoggerAwareInterface
{

    use LoggerAwareTrait;

    public $silent;

    public function beforeAction($actionID)
    {
        $return = parent::beforeAction($actionID);

        if ($this->silent)
        {
            $this->setLogger(new NullLogger);
        }
        else
        {
            $this->setLogger(new ConsoleLogger);
        }

        return $return;
    }

    public function options($actionID)
    {
        return array_merge(
            parent::options($actionID), 
            [
                'silent'
            ]
        );
    }
}
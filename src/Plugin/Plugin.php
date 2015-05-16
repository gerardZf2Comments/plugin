<?php

namespace Plugin;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Plugin\PluginEvents;

class Plugin implements PluginInterface, EventSubscriberInterface
{
    protected $composer;
    protected $io;

    public function activate(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;
    }

    public static function getSubscribedEvents()
    {
        return array(
            'post-package-install'  => array(
                array('plugin', 0)
            ),
        );
    }

    public function plugin($event)
    {
        ob_start();
        var_dump($event);
        $eventData = ob_get_clean();
        ob_start();
        var_dump($this);
        $thisData = ob_get_clean();
        file_put_contents('event'.time(), var_dump($eventData));
        file_put_contents('this'.time(), var_dump($thisData));
    }
}

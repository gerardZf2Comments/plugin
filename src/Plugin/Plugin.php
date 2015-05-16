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
        
        var_dump('package :: ',$event->getOperation()->getPackage());
        var_dump('target dir :: ',$event->getOperation()->getPackage()->getTargetDir());
       
    }
}

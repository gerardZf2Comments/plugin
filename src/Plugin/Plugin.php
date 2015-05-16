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

        var_dump('package :: ',$event->getOperation()->getPackage());

        $contents = ob_get_contents();
        
        ob_end_clean();
        file_put_contents('package'.time(), $contents);
        
        ob_start();

        var_dump('target dir :: ',$event->getOperation()->getPackage()->getTargetDir());

        $contents = ob_get_contents();
        ob_end_clean();
        file_put_contents('targetDir'.time(), $contents);
        
       
    }
}

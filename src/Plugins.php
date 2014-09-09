<?php

namespace Aztech\Events\Bus\Plugins;

use Aztech\Events\Bus\Events;
use Aztech\Events\Bus\Factory\GenericOptionsDescriptor;
use Aztech\Events\Bus\GenericPluginFactory;
use Aztech\Events\Bus\Plugins\File\FileChannelProvider;
use Aztech\Events\Bus\Plugins\Memory\MemoryChannelProvider;
use Aztech\Events\Bus\Plugins\Pdo\PdoChannelProvider;
use Aztech\Events\Bus\Plugins\Pdo\PdoOptionsDescriptor;
use Aztech\Events\Bus\Plugins\Socket\SocketChannelProvider;
use Aztech\Events\Bus\Plugins\Socket\SocketOptionsDescriptor;

class Plugins
{

    static function loadFilePlugin()
    {
        $descriptor = new GenericOptionsDescriptor();
        $descriptor->addOption('file');

        Events::addPlugin('file', new GenericPluginFactory(function ()
        {
            return new FileChannelProvider();
        }, $descriptor));
    }

    static function loadMemoryPlugin($name = 'memory')
    {
        Events::addPlugin($name, new GenericPluginFactory(function ()
        {
            return new MemoryChannelProvider();
        }));
    }

    static function loadSocketPlugin($name = 'socket')
    {
        Events::addPlugin($name, new GenericPluginFactory(function ()
        {
            return new SocketChannelProvider();
        }, new SocketOptionsDescriptor()));
    }

    static function loadPdoPlugin($name ='pdo')
    {
        Events::addPlugin($name, new GenericPluginFactory(function ()
        {
            return new PdoChannelProvider();
        }, new PdoOptionsDescriptor()));
    }
}

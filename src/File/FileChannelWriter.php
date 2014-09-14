<?php

namespace Aztech\Events\Bus\Plugins\File;

use Aztech\Events\Event;
use Aztech\Events\Bus\Channel\ChannelWriter;
use Aztech\Util\File\Files;

class FileChannelWriter implements ChannelWriter
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function write(Event $event, $serializedEvent)
    {
        if ($handle = fopen($this->file, "c+")) {
            if (Files::invokeEx(array($this, 'append'), $handle, $serializedEvent)) {
                fflush($handle);
            }

            fclose($handle);
        }
    }

    public function append($handle, $data)
    {
        while (fgets($handle) !== false) {
            continue;
        }

        fwrite($handle, $data . PHP_EOL);
    }
}

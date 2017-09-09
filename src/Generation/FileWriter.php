<?php

namespace IsoCurrency\Generation;

class FileWriter implements FileWriterInterface
{
    public function write($destination, $data)
    {
        file_put_contents($destination, $data);
    }
}

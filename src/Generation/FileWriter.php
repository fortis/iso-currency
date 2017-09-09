<?php

namespace IsoCurrency\Generation;

class FileWriter
{
    public function write($destination, $data)
    {
        file_put_contents($destination, $data);
    }
}

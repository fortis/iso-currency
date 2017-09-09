<?php

namespace IsoCurrency\Generation;

/**
 * Class FileWriter
 */
class FileWriter
{
    const FILENAME = 'IsoCurrency.php';

    public function write($data)
    {
        file_put_contents(__DIR__.'/../'.self::FILENAME, $data);
    }
}

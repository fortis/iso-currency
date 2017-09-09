<?php

namespace IsoCurrency\Generation;

use Twig_Environment;
use Twig_Loader_Filesystem;

class Generator
{
    /** @var Twig_Environment */
    private $twig;

    /** @var FileWriter */
    private $fileWriter;

    /**
     * Generator constructor.
     */
    public function __construct()
    {
        $path = __DIR__.'/../Resources/templates';
        $loader = new Twig_Loader_Filesystem($path);
        $this->twig = new Twig_Environment($loader);
        $this->fileWriter = new FileWriter();
    }

    /**
     * @param       $template
     * @param array $variables
     */
    public function generate($template, array $variables)
    {
        $data = $this->twig->render($template, $variables);
        $this->fileWriter->write($data);
    }
}

<?php

namespace IsoCurrency\Generation;

use IsoCurrency\Generation\FileWriterInterface;
use Twig_Environment;

class Generator
{
    /** @var Twig_Environment */
    private $twig;

    /** @var string */
    private $template;

    /** @var string */
    private $destination;
    /**
     * @var \IsoCurrency\Generation\FileWriter
     */
    private $fileWriter;

    /**
     * Generator constructor.
     * @param \Twig_Environment   $twig
     * @param FileWriter $fileWriter
     * @internal param string $template
     * @internal param string $destination
     */
    public function __construct(Twig_Environment $twig, FileWriter $fileWriter, $template, $destination)
    {
        $this->twig = $twig;
        $this->template = $template;
        $this->destination = $destination;
        $this->fileWriter = $fileWriter;
    }

    /**
     * @param array $variables
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function generate(array $variables)
    {
        $data = $this->twig->render($this->template, $variables);
        $this->fileWriter->write($this->destination, $data);
    }
}

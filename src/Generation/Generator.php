<?php

namespace IsoCurrency\Generation;

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
     * Generator constructor.
     * @param \Twig_Environment $twig
     * @param string            $template
     * @param string            $destination
     */
    public function __construct(Twig_Environment $twig, $template, $destination)
    {
        $this->twig = $twig;
        $this->template = $template;
        $this->destination = $destination;
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
        file_put_contents($this->destination, $data);
    }
}

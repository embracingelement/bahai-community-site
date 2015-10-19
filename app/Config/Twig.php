<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/18/15
 * Time: 9:14 PM
 */

namespace Config;


use Twig_Environment;
use Twig_Loader_Filesystem;

class Twig {
    private $twigLoader;
    private $twigEnvironment;

    function __construct(){
        $this->twigLoader = new Twig_Loader_Filesystem(APP_ROOT.'/templates');
        $this->twigEnvironment = new Twig_Environment($this->twigLoader, array(
            'cache' => APP_ROOT.'/templates/cache',
            'debug' => DEBUG
        ));
    }

    /**
     * @return Twig_Environment
     */
    public function getTwigEnvironment()
    {
        return $this->twigEnvironment;
    }

    /**
     * @return Twig_Loader_Filesystem
     */
    public function getTwigLoader()
    {
        return $this->twigLoader;
    }
}
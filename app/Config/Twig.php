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
    private $twig;

    function __construct(){
        $twig_loader = new Twig_Loader_Filesystem(APP_ROOT.'/templates');
        $this->twig = new Twig_Environment($twig_loader, array(
            'cache' => REPO_ROOT.'/cache/templates',
            'debug' => DEBUG
        ));
    }

    /**
     * @return Twig_Environment
     */
    public function getTwig()
    {
        return $this->twig;
    }
}
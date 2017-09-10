<?php
namespace Flyer;

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/17/15
 * Time: 5:39 PM
 */

class FlyerService {

    private $flyerDir;

    public function __construct($flyerDir)
    {
        $this->flyerDir = $flyerDir;
    }


    /**
     * @param Flyer[] $flyers
     * @return Flyer[]
     */
    function getFlyers(){
        $flyers = [];

        $files_in_root = $this->getFileInDir($this->flyerDir);

        foreach($files_in_root as $file){

            if(is_dir($file)){
              $files_in_dir = $this->getFileInDir($file);
              $new_flyer = false;

              if(sizeof($files_in_dir) == 1){
                  $new_flyer = new Flyer($this->getPathRelativeToPublic($files_in_dir[0]));
              }elseif (sizeof($files_in_dir) == 2){
                  if(false === strpos($files_in_dir[0],"thumbnail")){
                      $new_flyer = new Flyer($this->getPathRelativeToPublic($files_in_dir[0]), $this->getPathRelativeToPublic($files_in_dir[1]));
                  }else{
                      $new_flyer = new Flyer($this->getPathRelativeToPublic($files_in_dir[1]), $this->getPathRelativeToPublic($files_in_dir[0]));
                  }
              }

              if(false != $new_flyer){
                  array_push($flyers, $new_flyer);
              }
            }
        }

        return $flyers;
    }

    private function getFileInDir($dir){
        $filenames = array_diff(scandir($dir), array('..', '.'));

        $files = [];
        foreach ($filenames as $filename){
            array_push($files, $dir . '/' . $filename);
        }
        return $files;
    }

    private function getPathRelativeToPublic($path){
        return str_replace(PUBLIC_ROOT, "", $path);
    }
}
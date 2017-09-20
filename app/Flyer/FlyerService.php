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
     * @return Flyer[]
     */
    function getFlyers(){
        $flyers = [];

        $files_in_root = $this->getFilesInDir($this->flyerDir);

        foreach($files_in_root as $file){

            if(is_dir($file) && $this->dirShouldBeProcessed($file) && $this->flyerIsInTheFuture($file) ){

              $files_in_dir = $this->getFilesInDir($file);
              $large_and_thumbnail = $this->getLargeAndThumbnail($files_in_dir);

              array_push($flyers, new Flyer(
                  $this->getPathRelativeToPublic($large_and_thumbnail['large']),
                  $this->getPathRelativeToPublic($large_and_thumbnail['thumbnail'])
              ));
            }
        }

        return $flyers;
    }

    private function dirShouldBeProcessed($dir){
        $files_in_dir = $this->getFilesInDir($dir);
        return (sizeof($files_in_dir) == 1 || sizeof($files_in_dir) == 2) && $this->getFlyerDate($dir);
    }


    private function getLargeAndThumbnail($files_in_dir){
        $large_and_thumbnail = [];
        if(sizeof($files_in_dir) == 1){
            $large_and_thumbnail['large'] = $files_in_dir[0];
            $large_and_thumbnail['thumbnail'] = $files_in_dir[0];
        }elseif (sizeof($files_in_dir) == 2){
            if(false === strpos($files_in_dir[0],"thumbnail")){
                $large_and_thumbnail['large'] = $files_in_dir[0];
                $large_and_thumbnail['thumbnail'] = $files_in_dir[1];
            }else{
                $large_and_thumbnail['large'] = $files_in_dir[1];
                $large_and_thumbnail['thumbnail'] = $files_in_dir[0];
            }
        }

        return $large_and_thumbnail;
    }

    /**
     * @param $filename
     * @return bool
     */
    private function flyerIsInTheFuture($filename){
        $flyer_date = $this->getFlyerDate($filename);
        return $this->isDateInTheFuture($flyer_date);
    }

    /**
     * @param $date_array
     * @return bool
     */
    private function isDateInTheFuture($date_array){
        $current_date_array = getdate();

        if($date_array['year'] > $current_date_array['year']){
            return true;
        }else if($date_array['year'] < $current_date_array['year']){
            return false;
        }

        if($date_array['month'] > $current_date_array['mon']){
            return true;
        }else if($date_array['month'] < $current_date_array['mon']){
            return false;
        }

        if($date_array['day'] > $current_date_array['mday']){
            return true;
        }else if($date_array['day'] < $current_date_array['mday']){
            return false;
        }

        return true;
    }


    private function getFlyerDate($filename){
        $date_array = explode("::",array_pop(explode("/",$filename)));
        return !empty($date_array[1]) ? date_parse($date_array[0]) : false;
    }

    private function getFilesInDir($dir){
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
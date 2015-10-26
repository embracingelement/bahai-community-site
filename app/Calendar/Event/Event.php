<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/7/15
 * Time: 10:32 PM
 */

namespace Calendar\Event;

class Event {
    private $title;
    private $description;
    private $location;
    private $startDate;
    private $contactEmail;

    /**
     * @return String
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function getSplitLineTitle(){
        if(strpos($this->title,"(") !== false) {
            $splitTitle = explode("(", $this->title);
            return $splitTitle[0] . "<br/>(" . $splitTitle[1];
        }elseif(strpos($this->title,":") !== false){
            $splitTitle = explode(":",$this->title);
            return $splitTitle[0]. ":<br/>" . $splitTitle[1];
        }elseif(strpos($this->title,"-") !== false){
            $splitTitle = explode("-",$this->title);
            return $splitTitle[0]. "-<br/>" . $splitTitle[1];
        }else{
            return $this->title;
        }
    }

    /**
     * @param String $title
     */
    public function setTitle($title)
    {
        $this->title = $this->filterTitle($title);
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $this->formatDescription($description);
    }

    /**
     * @return mixed
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * @param mixed $contactEmail
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;
    }

    public function getContactName(){
        if(strpos($this->contactEmail,"@labahais.org") !== false){
            return ucfirst( explode("@",$this->contactEmail)[0] );
        }else{
            return $this->contactEmail;
        }
    }

    public function isFeatured(){
        return strpos(strtolower($this->title), strtolower("Featured Event:")) !== false;
    }

    private function filterTitle($title){
        $title = html_entity_decode(htmlspecialchars_decode($title), ENT_QUOTES);
        $title = str_replace(" - Holy Day on which work is to be suspended", "", $title);
        $title = str_replace("Commemoration", "Commemora-tion", $title);
        $title = str_replace("Commemorating", "Commemorat-ing", $title);

        return $title;
    }

    private $chr_map = array(
        // Windows codepage 1252
        "\xC2\x82" => "'", // U+0082?U+201A single low-9 quotation mark
        "\xC2\x84" => '"', // U+0084?U+201E double low-9 quotation mark
        "\xC2\x8B" => "'", // U+008B?U+2039 single left-pointing angle quotation mark
        "\xC2\x91" => "'", // U+0091?U+2018 left single quotation mark
        "\xC2\x92" => "'", // U+0092?U+2019 right single quotation mark
        "\xC2\x93" => '"', // U+0093?U+201C left double quotation mark
        "\xC2\x94" => '"', // U+0094?U+201D right double quotation mark
        "\xC2\x9B" => "'", // U+009B?U+203A single right-pointing angle quotation mark

            // Regular Unicode     // U+0022 quotation mark (")
            // U+0027 apostrophe     (')
        "\xC2\xAB"     => '"', // U+00AB left-pointing double angle quotation mark
        "\xC2\xBB"     => '"', // U+00BB right-pointing double angle quotation mark
        "\xE2\x80\x98" => "'", // U+2018 left single quotation mark
        "\xE2\x80\x99" => "'", // U+2019 right single quotation mark
        "\xE2\x80\x9A" => "'", // U+201A single low-9 quotation mark
        "\xE2\x80\x9B" => "'", // U+201B single high-reversed-9 quotation mark
        "\xE2\x80\x9C" => '"', // U+201C left double quotation mark
        "\xE2\x80\x9D" => '"', // U+201D right double quotation mark
        "\xE2\x80\x9E" => '"', // U+201E double low-9 quotation mark
        "\xE2\x80\x9F" => '"', // U+201F double high-reversed-9 quotation mark
        "\xE2\x80\xB9" => "'", // U+2039 single left-pointing angle quotation mark
        "\xE2\x80\xBA" => "'", // U+203A single right-pointing angle quotation mark
    );

    private function formatDescription($description){
        //Do some niceness to the description
        $description = html_entity_decode(htmlspecialchars_decode($description), ENT_QUOTES);
        //Make any URLs used in the description clickable
        $description = preg_replace('/&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml|caron);/i','$1',htmlentities(str_replace(array_keys  ($this->chr_map), array_values($this->chr_map), $description), ENT_QUOTES));
        $description = preg_replace('"\b(http://\S+)"', '<a href="$1">$1</a>', $description);

        // Make email addresses in the description clickable
        $description = preg_replace("`([-_a-z0-9]+(\.[-_a-z0-9]+)*@[-a-z0-9]+(\.[-a-z0-9]+)*\.[a-z]{2,6})`i","<a href=\"mailto:\\1\" title=\"\\1\">\\1</a>", $description);

        $description = htmlspecialchars($description, ENT_QUOTES);

        return $description;
    }
}
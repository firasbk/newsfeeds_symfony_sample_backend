<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="newsfeeds")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Newsfeeds\NewsfeedsRepository")
 */
class Newsfeeds
{     
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $newsfeeds_title;
    
    /**
     * @ORM\Column(type="text")
     */    
    private $newsfeeds_long_description;
    
    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $newsfeeds_short_description;
 
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $newsfeeds_main_image;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $newsfeeds_thumb_image;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $newsfeeds_date;

    /** @ORM\Column(type="datetime") */
    private $created_at;
 
    /** @ORM\Column(type="datetime") */
    private $updated_at;
    
    /** @ORM\Column(type="boolean") */
    private $published;    
    
    function getId() {
        return $this->id;
    }

    function getNewsfeeds_title() {
        return $this->newsfeeds_title;
    }

    function getNewsfeeds_long_description() {
        return $this->newsfeeds_long_description;
    }

    function getNewsfeeds_short_description() {
        return $this->newsfeeds_short_description;
    }

    function getNewsfeeds_main_image() {
        return $this->newsfeeds_main_image;
    }

    function getNewsfeeds_thumb_image() {
        return $this->newsfeeds_thumb_image;
    }

    function getNewsfeeds_date() {
        return $this->newsfeeds_date;
    }

    function getCreated_at() {
        return $this->created_at;
    }

    function getUpdated_at() {
        return $this->updated_at;
    }

    function getPublished() {
        return $this->published;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNewsfeeds_title($newsfeeds_title) {
        $this->newsfeeds_title = $newsfeeds_title;
    }

    function setNewsfeeds_long_description($newsfeeds_long_description) {
        $this->newsfeeds_long_description = $newsfeeds_long_description;
    }

    function setNewsfeeds_short_description($newsfeeds_short_description) {
        $this->newsfeeds_short_description = $newsfeeds_short_description;
    }

    function setNewsfeeds_main_image($newsfeeds_main_image) {
        $this->newsfeeds_main_image = $newsfeeds_main_image;
    }

    function setNewsfeeds_thumb_image($newsfeeds_thumb_image) {
        $this->newsfeeds_thumb_image = $newsfeeds_thumb_image;
    }

    function setNewsfeeds_date($newsfeeds_date) {
        $this->newsfeeds_date = $newsfeeds_date;
    }

    function setCreated_at($created_at) {
        $this->created_at = $created_at;
    }

    function setUpdated_at($updated_at) {
        $this->updated_at = $updated_at;
    }

    function setPublished($published) {
        $this->published = $published;
    }

    
    public function toArray()
    {
        $toreturn = array();
        foreach ($this as $key => $value) {
            $toreturn[$key] = $value;
        }
        return $toreturn;
    }
}
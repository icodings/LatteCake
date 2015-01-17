<?php

namespace Demo\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Life
 */
class Life
{
    /**
     * @var integer
     */
    private $id;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var string
     */
    private $life_title;

    /**
     * @var string
     */
    private $life_content;

    /**
     * @var integer
     */
    private $life_time;

    /**
     * @var integer
     */
    private $life_author;

    /**
     * @var string
     */
    private $life_source;

    /**
     * @var integer
     */
    private $life_read;

    /**
     * @var string
     */
    private $life_keyword;

    /**
     * @var string
     */
    private $life_tag;

    /**
     * @var integer
     */
    private $life_lastTime;


    /**
     * Set life_title
     *
     * @param string $lifeTitle
     * @return Life
     */
    public function setLifeTitle($lifeTitle)
    {
        $this->life_title = $lifeTitle;

        return $this;
    }

    /**
     * Get life_title
     *
     * @return string 
     */
    public function getLifeTitle()
    {
        return $this->life_title;
    }

    /**
     * Set life_content
     *
     * @param string $lifeContent
     * @return Life
     */
    public function setLifeContent($lifeContent)
    {
        $this->life_content = $lifeContent;

        return $this;
    }

    /**
     * Get life_content
     *
     * @return string 
     */
    public function getLifeContent()
    {
        return $this->life_content;
    }

    /**
     * Set life_time
     *
     * @param integer $lifeTime
     * @return Life
     */
    public function setLifeTime($lifeTime)
    {
        $this->life_time = $lifeTime;

        return $this;
    }

    /**
     * Get life_time
     *
     * @return integer 
     */
    public function getLifeTime()
    {
        return $this->life_time;
    }

    /**
     * Set life_author
     *
     * @param integer $lifeAuthor
     * @return Life
     */
    public function setLifeAuthor($lifeAuthor)
    {
        $this->life_author = $lifeAuthor;

        return $this;
    }

    /**
     * Get life_author
     *
     * @return integer 
     */
    public function getLifeAuthor()
    {
        return $this->life_author;
    }

    /**
     * Set life_source
     *
     * @param string $lifeSource
     * @return Life
     */
    public function setLifeSource($lifeSource)
    {
        $this->life_source = $lifeSource;

        return $this;
    }

    /**
     * Get life_source
     *
     * @return string 
     */
    public function getLifeSource()
    {
        return $this->life_source;
    }

    /**
     * Set life_read
     *
     * @param integer $lifeRead
     * @return Life
     */
    public function setLifeRead($lifeRead)
    {
        $this->life_read = $lifeRead;

        return $this;
    }

    /**
     * Get life_read
     *
     * @return integer 
     */
    public function getLifeRead()
    {
        return $this->life_read;
    }

    /**
     * Set life_keyword
     *
     * @param string $lifeKeyword
     * @return Life
     */
    public function setLifeKeyword($lifeKeyword)
    {
        $this->life_keyword = $lifeKeyword;

        return $this;
    }

    /**
     * Get life_keyword
     *
     * @return string 
     */
    public function getLifeKeyword()
    {
        return $this->life_keyword;
    }

    /**
     * Set life_tag
     *
     * @param string $lifeTag
     * @return Life
     */
    public function setLifeTag($lifeTag)
    {
        $this->life_tag = $lifeTag;

        return $this;
    }

    /**
     * Get life_tag
     *
     * @return string 
     */
    public function getLifeTag()
    {
        return $this->life_tag;
    }

    /**
     * Set life_lastTime
     *
     * @param integer $lifeLastTime
     * @return Life
     */
    public function setLifeLastTime($lifeLastTime)
    {
        $this->life_lastTime = $lifeLastTime;

        return $this;
    }

    /**
     * Get life_lastTime
     *
     * @return integer 
     */
    public function getLifeLastTime()
    {
        return $this->life_lastTime;
    }
    /**
     * @var string
     */
    private $life_image;


    /**
     * Set life_image
     *
     * @param string $lifeImage
     * @return Life
     */
    public function setLifeImage($lifeImage)
    {
        $this->life_image = $lifeImage;

        return $this;
    }

    /**
     * Get life_image
     *
     * @return string 
     */
    public function getLifeImage()
    {
        return $this->life_image;
    }
    /**
     * @var string
     */
    private $life_desc;


    /**
     * Set life_desc
     *
     * @param string $lifeDesc
     * @return Life
     */
    public function setLifeDesc($lifeDesc)
    {
        $this->life_desc = $lifeDesc;

        return $this;
    }

    /**
     * Get life_desc
     *
     * @return string 
     */
    public function getLifeDesc()
    {
        return $this->life_desc;
    }
}

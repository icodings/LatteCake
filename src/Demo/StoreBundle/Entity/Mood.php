<?php

namespace Demo\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mood
 */
class Mood
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
     * @var integer
     */
    private $mood_author;

    /**
     * @var integer
     */
    private $mood_time;

    /**
     * @var string
     */
    private $mood_content;


    /**
     * Set mood_author
     *
     * @param integer $moodAuthor
     * @return Mood
     */
    public function setMoodAuthor($moodAuthor)
    {
        $this->mood_author = $moodAuthor;

        return $this;
    }

    /**
     * Get mood_author
     *
     * @return integer 
     */
    public function getMoodAuthor()
    {
        return $this->mood_author;
    }

    /**
     * Set mood_time
     *
     * @param integer $moodTime
     * @return Mood
     */
    public function setMoodTime($moodTime)
    {
        $this->mood_time = $moodTime;

        return $this;
    }

    /**
     * Get mood_time
     *
     * @return integer 
     */
    public function getMoodTime()
    {
        return $this->mood_time;
    }

    /**
     * Set mood_content
     *
     * @param string $moodContent
     * @return Mood
     */
    public function setMoodContent($moodContent)
    {
        $this->mood_content = $moodContent;

        return $this;
    }

    /**
     * Get mood_content
     *
     * @return string 
     */
    public function getMoodContent()
    {
        return $this->mood_content;
    }
    /**
     * @var string
     */
    private $mood_title;


    /**
     * Set mood_title
     *
     * @param string $moodTitle
     * @return Mood
     */
    public function setMoodTitle($moodTitle)
    {
        $this->mood_title = $moodTitle;

        return $this;
    }

    /**
     * Get mood_title
     *
     * @return string 
     */
    public function getMoodTitle()
    {
        return $this->mood_title;
    }
}

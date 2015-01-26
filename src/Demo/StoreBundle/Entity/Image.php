<?php

namespace Demo\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 */
class Image
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
    private $image_name;

    /**
     * @var string
     */
    private $image_path;

    /**
     * @var integer
     */
    private $image_height;

    /**
     * @var integer
     */
    private $image_action;

    /**
     * @var string
     */
    private $image_time;

    /**
     * @var integer
     */
    private $image_status;

    /**
     * @var integer
     */
    private $image_relatedId;


    /**
     * Set image_name
     *
     * @param string $imageName
     * @return Image
     */
    public function setImageName($imageName)
    {
        $this->image_name = $imageName;

        return $this;
    }

    /**
     * Get image_name
     *
     * @return string 
     */
    public function getImageName()
    {
        return $this->image_name;
    }

    /**
     * Set image_path
     *
     * @param string $imagePath
     * @return Image
     */
    public function setImagePath($imagePath)
    {
        $this->image_path = $imagePath;

        return $this;
    }

    /**
     * Get image_path
     *
     * @return string 
     */
    public function getImagePath()
    {
        return $this->image_path;
    }

    /**
     * Set image_height
     *
     * @param integer $imageHeight
     * @return Image
     */
    public function setImageHeight($imageHeight)
    {
        $this->image_height = $imageHeight;

        return $this;
    }

    /**
     * Get image_height
     *
     * @return integer 
     */
    public function getImageHeight()
    {
        return $this->image_height;
    }

    /**
     * Set image_action
     *
     * @param integer $imageAction
     * @return Image
     */
    public function setImageAction($imageAction)
    {
        $this->image_action = $imageAction;

        return $this;
    }

    /**
     * Get image_action
     *
     * @return integer 
     */
    public function getImageAction()
    {
        return $this->image_action;
    }

    /**
     * Set image_time
     *
     * @param string $imageTime
     * @return Image
     */
    public function setImageTime($imageTime)
    {
        $this->image_time = $imageTime;

        return $this;
    }

    /**
     * Get image_time
     *
     * @return string 
     */
    public function getImageTime()
    {
        return $this->image_time;
    }

    /**
     * Set image_status
     *
     * @param integer $imageStatus
     * @return Image
     */
    public function setImageStatus($imageStatus)
    {
        $this->image_status = $imageStatus;

        return $this;
    }

    /**
     * Get image_status
     *
     * @return integer 
     */
    public function getImageStatus()
    {
        return $this->image_status;
    }

    /**
     * Set image_relatedId
     *
     * @param integer $imageRelatedId
     * @return Image
     */
    public function setImageRelatedId($imageRelatedId)
    {
        $this->image_relatedId = $imageRelatedId;

        return $this;
    }

    /**
     * Get image_relatedId
     *
     * @return integer 
     */
    public function getImageRelatedId()
    {
        return $this->image_relatedId;
    }
}

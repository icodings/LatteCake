<?php

namespace Demo\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 */
class Users
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $user_login;

    /**
     * @var string
     */
    private $user_niceName;

    /**
     * @var string
     */
    private $user_pass;

    /**
     * @var integer
     */
    private $user_time;

    /**
     * @var string
     */
    private $user_email;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $Posts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set user_login
     *
     * @param string $userLogin
     * @return Users
     */
    public function setUserLogin($userLogin)
    {
        $this->user_login = $userLogin;

        return $this;
    }

    /**
     * Get user_login
     *
     * @return string 
     */
    public function getUserLogin()
    {
        return $this->user_login;
    }

    /**
     * Set user_niceName
     *
     * @param string $userNiceName
     * @return Users
     */
    public function setUserNiceName($userNiceName)
    {
        $this->user_niceName = $userNiceName;

        return $this;
    }

    /**
     * Get user_niceName
     *
     * @return string 
     */
    public function getUserNiceName()
    {
        return $this->user_niceName;
    }

    /**
     * Set user_pass
     *
     * @param string $userPass
     * @return Users
     */
    public function setUserPass($userPass)
    {
        $this->user_pass = $userPass;

        return $this;
    }

    /**
     * Get user_pass
     *
     * @return string 
     */
    public function getUserPass()
    {
        return $this->user_pass;
    }

    /**
     * Set user_time
     *
     * @param integer $userTime
     * @return Users
     */
    public function setUserTime($userTime)
    {
        $this->user_time = $userTime;

        return $this;
    }

    /**
     * Get user_time
     *
     * @return integer 
     */
    public function getUserTime()
    {
        return $this->user_time;
    }

    /**
     * Set user_email
     *
     * @param string $userEmail
     * @return Users
     */
    public function setUserEmail($userEmail)
    {
        $this->user_email = $userEmail;

        return $this;
    }

    /**
     * Get user_email
     *
     * @return string 
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * Add Posts
     *
     * @param \Demo\StoreBundle\Entity\Posts $posts
     * @return Users
     */
    public function addPost(\Demo\StoreBundle\Entity\Posts $posts)
    {
        $this->Posts[] = $posts;

        return $this;
    }

    /**
     * Remove Posts
     *
     * @param \Demo\StoreBundle\Entity\Posts $posts
     */
    public function removePost(\Demo\StoreBundle\Entity\Posts $posts)
    {
        $this->Posts->removeElement($posts);
    }

    /**
     * Get Posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->Posts;
    }
    /**
     * @var string
     */
    private $user_key;

    /**
     * @var string
     */
    private $user_url;

    /**
     * @var string
     */
    private $user_duoId;


    /**
     * Set user_key
     *
     * @param string $userKey
     * @return Users
     */
    public function setUserKey($userKey)
    {
        $this->user_key = $userKey;

        return $this;
    }

    /**
     * Get user_key
     *
     * @return string 
     */
    public function getUserKey()
    {
        return $this->user_key;
    }

    /**
     * Set user_url
     *
     * @param string $userUrl
     * @return Users
     */
    public function setUserUrl($userUrl)
    {
        $this->user_url = $userUrl;

        return $this;
    }

    /**
     * Get user_url
     *
     * @return string 
     */
    public function getUserUrl()
    {
        return $this->user_url;
    }

    /**
     * Set user_duoId
     *
     * @param string $userDuoId
     * @return Users
     */
    public function setUserDuoId($userDuoId)
    {
        $this->user_duoId = $userDuoId;

        return $this;
    }

    /**
     * Get user_duoId
     *
     * @return string 
     */
    public function getUserDuoId()
    {
        return $this->user_duoId;
    }
}

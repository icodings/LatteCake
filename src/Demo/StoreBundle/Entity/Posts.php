<?php

namespace Demo\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Posts
 */
class Posts
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $post_title;

    /**
     * @var integer
     */
    private $post_time;

    /**
     * @var string
     */
    private $post_content;

    /**
     * @var string
     */
    private $post_desc;

    /**
     * @var integer
     */
    private $post_author;

    /**
     * @var integer
     */
    private $post_action;

    /**
     * @var \Demo\StoreBundle\Entity\Users
     */
    private $Users;


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
     * Set post_title
     *
     * @param string $postTitle
     * @return Posts
     */
    public function setPostTitle($postTitle)
    {
        $this->post_title = $postTitle;

        return $this;
    }

    /**
     * Get post_title
     *
     * @return string 
     */
    public function getPostTitle()
    {
        return $this->post_title;
    }

    /**
     * Set post_time
     *
     * @param integer $postTime
     * @return Posts
     */
    public function setPostTime($postTime)
    {
        $this->post_time = $postTime;

        return $this;
    }

    /**
     * Get post_time
     *
     * @return integer 
     */
    public function getPostTime()
    {
        return $this->post_time;
    }

    /**
     * Set post_content
     *
     * @param string $postContent
     * @return Posts
     */
    public function setPostContent($postContent)
    {
        $this->post_content = $postContent;

        return $this;
    }

    /**
     * Get post_content
     *
     * @return string 
     */
    public function getPostContent()
    {
        return $this->post_content;
    }

    /**
     * Set post_desc
     *
     * @param string $postDesc
     * @return Posts
     */
    public function setPostDesc($postDesc)
    {
        $this->post_desc = $postDesc;

        return $this;
    }

    /**
     * Get post_desc
     *
     * @return string 
     */
    public function getPostDesc()
    {
        return $this->post_desc;
    }

    /**
     * Set post_author
     *
     * @param integer $postAuthor
     * @return Posts
     */
    public function setPostAuthor($postAuthor)
    {
        $this->post_author = $postAuthor;

        return $this;
    }

    /**
     * Get post_author
     *
     * @return integer 
     */
    public function getPostAuthor()
    {
        return $this->post_author;
    }

    /**
     * Set post_action
     *
     * @param integer $postAction
     * @return Posts
     */
    public function setPostAction($postAction)
    {
        $this->post_action = $postAction;

        return $this;
    }

    /**
     * Get post_action
     *
     * @return integer 
     */
    public function getPostAction()
    {
        return $this->post_action;
    }

    /**
     * Set Users
     *
     * @param \Demo\StoreBundle\Entity\Users $users
     * @return Posts
     */
    public function setUsers(\Demo\StoreBundle\Entity\Users $users = null)
    {
        $this->Users = $users;

        return $this;
    }

    /**
     * Get Users
     *
     * @return \Demo\StoreBundle\Entity\Users 
     */
    public function getUsers()
    {
        return $this->Users;
    }
}

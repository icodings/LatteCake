<?php

namespace Demo\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comments
 */
class Comments
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
    private $comment_logId;

    /**
     * @var integer
     */
    private $comment_userId;

    /**
     * @var string
     */
    private $comment_action;

    /**
     * @var integer
     */
    private $comment_postId;

    /**
     * @var integer
     */
    private $comment_threadId;

    /**
     * @var integer
     */
    private $comment_threadKey;

    /**
     * @var string
     */
    private $comment_ip;

    /**
     * @var string
     */
    private $comment_createdAt;

    /**
     * @var string
     */
    private $comment_message;

    /**
     * @var string
     */
    private $comment_status;

    /**
     * @var integer
     */
    private $comment_parentId;

    /**
     * @var integer
     */
    private $comment_type;


    /**
     * Set comment_logId
     *
     * @param integer $commentLogId
     * @return Comments
     */
    public function setCommentLogId($commentLogId)
    {
        $this->comment_logId = $commentLogId;

        return $this;
    }

    /**
     * Get comment_logId
     *
     * @return integer 
     */
    public function getCommentLogId()
    {
        return $this->comment_logId;
    }

    /**
     * Set comment_userId
     *
     * @param integer $commentUserId
     * @return Comments
     */
    public function setCommentUserId($commentUserId)
    {
        $this->comment_userId = $commentUserId;

        return $this;
    }

    /**
     * Get comment_userId
     *
     * @return integer 
     */
    public function getCommentUserId()
    {
        return $this->comment_userId;
    }

    /**
     * Set comment_action
     *
     * @param string $commentAction
     * @return Comments
     */
    public function setCommentAction($commentAction)
    {
        $this->comment_action = $commentAction;

        return $this;
    }

    /**
     * Get comment_action
     *
     * @return string 
     */
    public function getCommentAction()
    {
        return $this->comment_action;
    }

    /**
     * Set comment_postId
     *
     * @param integer $commentPostId
     * @return Comments
     */
    public function setCommentPostId($commentPostId)
    {
        $this->comment_postId = $commentPostId;

        return $this;
    }

    /**
     * Get comment_postId
     *
     * @return integer 
     */
    public function getCommentPostId()
    {
        return $this->comment_postId;
    }

    /**
     * Set comment_threadId
     *
     * @param integer $commentThreadId
     * @return Comments
     */
    public function setCommentThreadId($commentThreadId)
    {
        $this->comment_threadId = $commentThreadId;

        return $this;
    }

    /**
     * Get comment_threadId
     *
     * @return integer 
     */
    public function getCommentThreadId()
    {
        return $this->comment_threadId;
    }

    /**
     * Set comment_threadKey
     *
     * @param integer $commentThreadKey
     * @return Comments
     */
    public function setCommentThreadKey($commentThreadKey)
    {
        $this->comment_threadKey = $commentThreadKey;

        return $this;
    }

    /**
     * Get comment_threadKey
     *
     * @return integer 
     */
    public function getCommentThreadKey()
    {
        return $this->comment_threadKey;
    }

    /**
     * Set comment_ip
     *
     * @param string $commentIp
     * @return Comments
     */
    public function setCommentIp($commentIp)
    {
        $this->comment_ip = $commentIp;

        return $this;
    }

    /**
     * Get comment_ip
     *
     * @return string 
     */
    public function getCommentIp()
    {
        return $this->comment_ip;
    }

    /**
     * Set comment_createdAt
     *
     * @param string $commentCreatedAt
     * @return Comments
     */
    public function setCommentCreatedAt($commentCreatedAt)
    {
        $this->comment_createdAt = $commentCreatedAt;

        return $this;
    }

    /**
     * Get comment_createdAt
     *
     * @return string 
     */
    public function getCommentCreatedAt()
    {
        return $this->comment_createdAt;
    }

    /**
     * Set comment_message
     *
     * @param string $commentMessage
     * @return Comments
     */
    public function setCommentMessage($commentMessage)
    {
        $this->comment_message = $commentMessage;

        return $this;
    }

    /**
     * Get comment_message
     *
     * @return string 
     */
    public function getCommentMessage()
    {
        return $this->comment_message;
    }

    /**
     * Set comment_status
     *
     * @param string $commentStatus
     * @return Comments
     */
    public function setCommentStatus($commentStatus)
    {
        $this->comment_status = $commentStatus;

        return $this;
    }

    /**
     * Get comment_status
     *
     * @return string 
     */
    public function getCommentStatus()
    {
        return $this->comment_status;
    }

    /**
     * Set comment_parentId
     *
     * @param integer $commentParentId
     * @return Comments
     */
    public function setCommentParentId($commentParentId)
    {
        $this->comment_parentId = $commentParentId;

        return $this;
    }

    /**
     * Get comment_parentId
     *
     * @return integer 
     */
    public function getCommentParentId()
    {
        return $this->comment_parentId;
    }

    /**
     * Set comment_type
     *
     * @param integer $commentType
     * @return Comments
     */
    public function setCommentType($commentType)
    {
        $this->comment_type = $commentType;

        return $this;
    }

    /**
     * Get comment_type
     *
     * @return integer 
     */
    public function getCommentType()
    {
        return $this->comment_type;
    }
    /**
     * @var string
     */
    private $comment_agent;


    /**
     * Set comment_agent
     *
     * @param string $commentAgent
     * @return Comments
     */
    public function setCommentAgent($commentAgent)
    {
        $this->comment_agent = $commentAgent;

        return $this;
    }

    /**
     * Get comment_agent
     *
     * @return string 
     */
    public function getCommentAgent()
    {
        return $this->comment_agent;
    }
}

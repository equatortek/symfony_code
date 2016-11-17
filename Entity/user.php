<?php
/**
 * Created by PhpStorm.
 * User: Employee Login
 * Date: 18/11/15
 * Time: 5:26 PM
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class user {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $userId;
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $userName;
    /**
     * @ORM\Column(type="string", length=50)
    */
    protected $password;
    /**
     * @ORM\Column(type="integer")
    */
    protected $isLocked;
    /**
     * @ORM\Column(type="integer")
    */
    protected $isActive;
    /**
     * @ORM\Column(type="integer")
    */
    protected $isDeleted;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $lastLogin;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdDate;
    /**
     * @ORM\Column(type="integer")
    */
    protected $verificationStatus;
	
	/**
     * @ORM\Column(type="integer")
     */
    protected $isAdmin;


    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set userName
     *
     * @param string $userName
     * @return user
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string 
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return user
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set isLocked
     *
     * @param integer $isLocked
     * @return user
     */
    public function setIsLocked($isLocked)
    {
        $this->isLocked = $isLocked;

        return $this;
    }

    /**
     * Get isLocked
     *
     * @return integer 
     */
    public function getIsLocked()
    {
        return $this->isLocked;
    }

    /**
     * Set isActive
     *
     * @param integer $isActive
     * @return user
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return integer 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set isDeleted
     *
     * @param integer $isDeleted
     * @return user
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Get isDeleted
     *
     * @return integer 
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * Set lastLogin
     *
     * @param \DateTime $lastLogin
     * @return user
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime 
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     * @return user
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime 
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set verificationStatus
     *
     * @param integer $verificationStatus
     * @return user
     */
    public function setVerificationStatus($verificationStatus)
    {
        $this->verificationStatus = $verificationStatus;

        return $this;
    }

    /**
     * Get verificationStatus
     *
     * @return integer 
     */
    public function getVerificationStatus()
    {
        return $this->verificationStatus;
    }
	
	/**
     * Set isAdmin
     *
     * @param integer $isAdmin
     * @return user
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Get isAdmin
     *
     * @return integer 
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }
}

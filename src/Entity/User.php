<?php
// src/AppBundle/Entity/User.php

namespace App\Entity;

use FOS\UserBundle\Model\User as FOSUser;
use Doctrine\ORM\Mapping as ORM;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints as Recaptcha;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends FOSUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @Recaptcha\IsTrue
     */
    public $recaptcha;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}
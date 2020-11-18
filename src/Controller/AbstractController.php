<?php


namespace App\Controller;


use App\Entity\User;

class AbstractController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @return object|User|null
     */
    protected function getUser()
    {
        return parent::getUser();
    }
}
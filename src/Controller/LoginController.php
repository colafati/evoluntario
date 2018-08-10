<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function index()
    {
        $form = $this->createFormBuilder()
                ->setAction($this->generateUrl('login'))
                ->add('usuario', TextType::class, array('attr' => ['class'=>'form-control']))
                ->add('senha', PasswordType::class, array('attr' => ['class'=>'form-control']))
                ->getForm();
        return $this->render('login/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/login_check", name="login_check")
     */
    public function login()
    {
        
    }
}

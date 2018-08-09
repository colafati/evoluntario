<?php

namespace App\Controller;

use App\Entity\Trabalho;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdminTrabalhoCadastroController extends Controller
{
    /**
     * @Route("/admin/trabalho/cadastro", name="admin_trabalho_cadastro")
     */
    public function index()
    {
        $trabalho = new Trabalho();
        
        $form = $this->createFormBuilder($trabalho)
                ->add('instituicao', TextType::class)
                ->getForm();
        
        return $this->render('admin_trabalho_cadastro/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

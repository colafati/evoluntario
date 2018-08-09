<?php

namespace App\Controller;

use App\Entity\Trabalho;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdminTrabalhoCadastroController extends Controller
{
    /**
     * @Route("/admin/trabalho/cadastro", name="admin_trabalho_cadastro")
     */
    public function index(Request $request)
    {
        $trabalho = new Trabalho();
        
        $form = $this->createFormBuilder($trabalho)
                ->setAction($this->generateUrl('admin_trabalho_cadastro'))
                ->add('instituicao', TextType::class)
                ->add('categoria', ChoiceType::class, ['choices'=>['Animais'=>'animais','Crianças'=>'criancas','Idosos'=>'idosos','Moradia'=>'moradia','Outros'=>'outros']])
                ->add('dataInicio', DateType::class)
                ->add('dataFim', DateType::class)
                ->add('periodo', TextType::class)
                ->add('site', TextType::class)
                ->add('cidade', TextType::class)
                ->add('telefone', TextType::class)
                ->add('email', TextType::class)
                ->add('descricao', TextareaType::class)
                ->add('salvar', SubmitType::class, array('label' => 'Salvar Trabalho'))
                ->getForm();
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trabalho);
            $entityManager->flush();
        }

        return $this->render('admin_trabalho_cadastro/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
}

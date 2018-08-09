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
use Symfony\Component\Form\Extension\Core\Type\EmailType;

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
                ->add('instituicao', TextType::class, array('attr' => ['class'=>'form-control']))
                ->add('categoria', ChoiceType::class, ['choices'=>['Animais'=>'animais','Crianças'=>'criancas','Idosos'=>'idosos','Moradia'=>'moradia','Outros'=>'outros'], 'attr' => ['class'=>'form-control']])
                ->add('dataInicio', DateType::class, array('attr' => ['class'=>'form-control']))
                ->add('dataFim', DateType::class, array('attr' => ['class'=>'form-control']))
                ->add('periodo', TextType::class, array('attr' => ['class'=>'form-control']))
                ->add('site', TextType::class, array('attr' => ['class'=>'form-control']))
                ->add('cidade', TextType::class, array('attr' => ['class'=>'form-control']))
                ->add('telefone', TextType::class, array('attr' => ['class'=>'form-control']))
                ->add('email', EmailType::class, array('attr' => ['class'=>'form-control']))
                ->add('descricao', TextareaType::class, array('attr' => ['class'=>'form-control']))
                ->add('salvar', SubmitType::class, array('label' => 'Salvar Trabalho','attr' => ['class'=>'btn btn-primary']))
                ->getForm();
        
        $form->handleRequest($request);
        $confirm = false;
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trabalho);
            $entityManager->flush();
            $confirm = true;
        }

        return $this->render('admin_trabalho_cadastro/index.html.twig', [
            'form' => $form->createView(), 'confirm'=>$confirm
        ]);
    }    
}
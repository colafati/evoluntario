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
                ->add('instituicao', TextType::class, array('attr' => ['class'=>'form-control col-sm-6']))
                ->add('categoria', ChoiceType::class, ['choices'=>['Animais'=>'animais','Crianças'=>'criancas','Idosos'=>'idosos','Moradia'=>'moradia','Outros'=>'outros'], 'attr' => ['class'=>'form-control col-sm-6']])
                ->add('dataInicio', DateType::class, array('attr' => ['class'=>'form-control'], 'widget'=>'single_text'))
                ->add('dataFim', DateType::class, array('attr' => ['class'=>'form-control'], 'widget'=>'single_text'))
                ->add('periodo', TextType::class, array('attr' => ['class'=>'form-control']))
                ->add('site', TextType::class, array('attr' => ['class'=>'form-control']))
                ->add('cidade', TextType::class, array('attr' => ['class'=>'form-control']))
                ->add('telefone', TextType::class, array('attr' => ['class'=>'form-control']))
                ->add('email', TextType::class, array('attr' => ['class'=>'form-control']))
                ->add('descricao', TextareaType::class, array('attr' => ['class'=>'form-control']))
                ->add('salvar', SubmitType::class, array('label' => 'Salvar Trabalho','attr' => ['class'=>'btn btn-primary']))
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
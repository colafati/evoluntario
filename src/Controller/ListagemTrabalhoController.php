<?php

namespace App\Controller;

use App\Entity\Trabalho;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListagemTrabalhoController extends Controller
{
    /**
     * @Route("/trabalhos", name="listagem_trabalho")
     */
    public function index()
    {
        
        $em = $this->getDoctrine()->getRepository(Trabalho::class);
        $trabalhos = $em->findAll();
        
        return $this->render('listagem_trabalho/index.html.twig', [
            'trabalhos' => $trabalhos,
        ]);
    }
}

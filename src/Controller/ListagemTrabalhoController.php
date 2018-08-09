<?php

namespace App\Controller;

use App\Entity\Trabalho;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ListagemTrabalhoController extends Controller
{
    /**
     * @Route("/trabalhos", name="listagem_trabalho")
     */
    public function index(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Trabalho::class);
        
        $qb = $repository->createQueryBuilder('t')
            ->select(array('t.cidade'))
            ->groupBy('t.cidade')
            ->orderBy('t.cidade', 'ASC')
            ->getQuery();
        $cidades = $qb->execute();
        
        $trabalhoEntity = $this->getDoctrine()->getRepository(Trabalho::class);
        
        $qb = $repository->createQueryBuilder('t');
        
        if(!empty($request->get('cidade'))) {
            $qb->andWhere('t.cidade = :cidade')
                ->setParameter('cidade', $request->get('cidade'));
        }
        $qb->orderBy('t.id', 'DESC');
        $trabalhos = $qb->getQuery()->execute();
        
        return $this->render('listagem_trabalho/index.html.twig', [
            'trabalhos' => $trabalhos,
            'cidades' => $cidades,
            'request' => array(
                'cidade' => $request->get('cidade') ?? null,
                'data' => $request->get('data') ?? null,
                'texto' => $request->get('texto') ?? null,
                'categoria' => $request->get('categoria') ?? null,
            ),
        ]);
    }
}

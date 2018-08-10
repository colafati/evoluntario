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
        
        $qb = $repository->createQueryBuilder('t')
            ->select(array('t.categoria'))
            ->groupBy('t.categoria')
            ->orderBy('t.categoria', 'ASC')
            ->getQuery();
        $categorias = $qb->execute();
        
        
        $qb = $repository->createQueryBuilder('t');
        
        if (!empty($request->get('cidade'))) {
            $qb->andWhere('t.cidade = :cidade')
                ->setParameter('cidade', $request->get('cidade'));
        }
        
        if (!empty($request->get('categoria'))) {
            $qb->andWhere('t.categoria = :categoria')
                ->setParameter('categoria', $request->get('categoria'));
        }
        
        if (!empty($request->get('data'))) {
            $qb->andWhere('t.dataInicio <= :data AND t.dataFim >= :data')
                ->setParameter('data', $request->get('data'));
        }
        
        if (!empty($request->get('texto'))) {
            $qb->andWhere('t.descricao LIKE :texto')
                ->setParameter('texto', '%'.str_replace(' ', '%', $request->get('texto')).'%');
        }
        
        /* paginação */
        $registrosPorPagina = 10;
        $pagina = ($request->get('pagina') > 0) ? (int) $request->get('pagina') : 1;
        
        $qb2 = $qb;
        $qb2->select(array('count(t.id) as total'));
        $trabalhosContagem = $qb2->getQuery()->execute();
        $total = !empty($trabalhosContagem[0]['total']) ? (int) $trabalhosContagem[0]['total'] : 0;
        $paginas = ceil($total / $registrosPorPagina);
        
        $qb->setFirstResult($registrosPorPagina * ($pagina - 1))
            ->setMaxResults($registrosPorPagina);
        
        $qb->select(array('t'));
        $qb->orderBy('t.id', 'DESC');
        $trabalhos = $qb->getQuery()->execute();
        
        return $this->render('listagem_trabalho/index.html.twig', [
            'trabalhos' => $trabalhos,
            'cidades' => $cidades,
            'categorias' => $categorias,
            'pagina' => $pagina ?? 1,
            'paginas' => $paginas ?? 1,
            'request' => array(
                'cidade' => $request->get('cidade') ?? null,
                'data' => $request->get('data') ?? null,
                'texto' => $request->get('texto') ?? null,
                'categoria' => $request->get('categoria') ?? null,
                'pagina' => $pagina ?? 1,
            ),
        ]);
    }
}

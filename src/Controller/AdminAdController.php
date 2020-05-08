<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Repository\AdRepository;
use App\Service\PaginationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminAdController extends AbstractController
{
    /**
     * @Route("/admin/ads/{page}", name="admin_ads_index", requirements={"page": "\d+"})
     */
    public function index(AdRepository $repo, $page = 1, PaginationService $pagination)
    {
//        $limit = 10;
//
//        $start = $page * $limit - $limit;
//        // 1 * 10 = 10 - 10 = 0
//        // 2 * 10 = 20 - 10 = 10
//
//        $total = count($repo->findAll());
//        $pages = ceil($total / $limit );

        $pagination->setEntityClass(Ad::class);
        $pagination->setCurrentPage($page);

        return $this->render('admin/ad/index.html.twig', [
            'pagination'=>$pagination
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="homepage")
     */
    public function home()
    {
        $prenoms = ["Lior" =>31,"Joseph" =>12,"Anne"=>55];

        return $this->render(
            'home.html.twig',
            [ 'title' => "Au revoir tout le monde ",
                'age' => 13,
                'tableau' => $prenoms
            ]
        );
    }
}
?>
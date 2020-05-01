<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * Montre la page qui dit bonjour
     *
     * @Route("/hello/{prenom}/age/{age}", name="hello")
     * @Route("/hello", name="hello_base")
     * @Route("/hello/{prenom}", name="hello_prenom")
     *
     */
    public function hello($prenom = "anonyme", $age = 0){
        return $this->render( 'hello.html.twig',
            ['prenom'=>$prenom,
                'age'=>$age
            ]
        );
    }




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
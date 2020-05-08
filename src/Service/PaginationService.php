<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Environment;

class PaginationService{

    private $entityClass;
    private $limit = 10;
    private $currentPage = 1;
    private $manager;
    private $twig;
    private $route;
    private $templatePath;

    /**
     * @return mixed
     */
    public function getTemplatePath()
    {
        return $this->templatePath;
    }

    /**
     * @param mixed $templatePath
     */
    public function setTemplatePath($templatePath): void
    {
        $this->templatePath = $templatePath;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     */
    public function setRoute($route): void
    {
        $this->route = $route;
    }

    /**
     * PaginationService constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager, Environment $twig, RequestStack $request, $templatePath )
    {
        $this->route = $request->getCurrentRequest()->attributes->get('_route');
        $this->manager = $manager;
        $this->twig = $twig;
        $this->templatePath = $templatePath;
    }

    public function display(){
        $this->twig->display($this->templatePath, [
            'page'=>$this->currentPage,
            'pages'=>$this->getPages(),
            'route'=> $this->route
        ]);
    }


    public function getPages(){
        if(empty($this->entityClass)){
            throw new \Exception("Vous n'avez pas spécifié l'entité sur laquelle
            nous devons paginer. Utilisez la méthode setEntityClass() de votre objet PaginationService");
        }
        // Connaitre le total des enregistrements de la table
        $repo = $this->manager->getRepository($this->entityClass);
        $total = count($repo->findAll());
        // Faire la division, l'arrondi et le renvoyer
        $pages = ceil($total / $this->limit);


        return $pages;
    }




    public function getData(){
        if(empty($this->entityClass)){
            throw new \Exception("Vous n'avez pas spécifié l'entité sur laquelle
            nous devons paginer. Utilisez la méthode setEntityClass() de votre objet PaginationService");
        }
        // Calculer l'offset
        $offset = $this->currentPage * $this->limit - $this->limit;
        // Demander au repository de retrouver les éléments
        $repo = $this->manager->getRepository($this->entityClass);
        $data = $repo->findBy([],[],$this->limit, $offset);
        // Renvoyer les éléments en question
        return $data;
    }


    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @param int $currentPage
     */
    public function setCurrentPage(int $currentPage): void
    {
        $this->currentPage = $currentPage;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @return mixed
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * @param mixed $entityClass
     */
    public function setEntityClass($entityClass): void
    {
        $this->entityClass = $entityClass;
    }



}
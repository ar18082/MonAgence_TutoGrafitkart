<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Property;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
       $repository = $entityManager ->getRepository(Property::class); 
       $properties = $repository->findAll();

       

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'properties' => $properties
        ]);
    }

    
}

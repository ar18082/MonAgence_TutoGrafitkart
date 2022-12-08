<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Property;
use Doctrine\ORM\EntityManagerInterface;

class PropertyController extends AbstractController
{
    
    #[Route('/biens', name: 'property.index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager ->getRepository(Property::class);
        $property = $repository->findAllVisible();
        dump($property);      
        /*$property[0] ->setSold(true);
        $entityManager->flush();*/

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'controller_name' => 'Les biens',
        ]);
    }

    #[Route('/biens/{id}', name:'property.show')]
    public function show($id, EntityManagerInterface $entityManager):Response
    {
        $repository = $entityManager ->getRepository(Property::class);
        $property = $repository->find($id);
        return $this->render('property/show.html.twig', [
            'current_menu' => 'properties',
            'property'=>$property,
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Property;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\PropertyType;



class AdminPropertyController extends AbstractController
{
    #[Route('/admin', name: 'admin_property_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Property::class);
        $properties = $repository->findAll();
        
        return $this->render('admin_property/index.html.twig', [
            'controller_name' => 'AdminPropertyController',
            'properties' => $properties
        ]);
    }

    #[Route('/admin/new', name: 'admin_property_new')]
    public function new( Request $request, EntityManagerInterface $entityManager): Response
    {
        $property = new Property;

        $form = $this->createForm(PropertyType::class, $property);
        $form ->handleRequest($request);
        
   
        if($form->isSubmitted() && $form ->isValid()){

        
            $property = $form ->getData();
            
            
            
            $entityManager->persist($property);
            $entityManager->flush();
        
            return $this->redirectToRoute('admin_property_index');
        }
        


        
        return $this->render('admin_property/new.html.twig', [
            'property' => $property,
            'form' => $form -> createView(),
        ]);
    }


    #[Route('/admin/{id}', name: 'admin_property_edit')]
    public function edit(Property $property, Request $request, EntityManagerInterface $entityManager): Response
    {
       
        $form = $this->createForm(PropertyType::class, $property);
        $form ->handleRequest($request);

        if($form->isSubmitted()&& $form ->isValid()){
            $entityManager->flush();
            return $this->redirectToRoute('admin_property_index');
        }
        
        return $this->render('admin_property/edit.html.twig', [
            'property' => $property,
            'form' => $form -> createView(),
        ]);
    }
}

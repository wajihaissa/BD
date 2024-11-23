<?php

namespace App\Controller;

use App\Entity\Employer;
use App\Form\EmployerFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MyController extends AbstractController
{
    #[Route('/my', name: 'app_my')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Create a new Employer entity
        $emp = new Employer();

        // Create the form for the Employer entity
        $form1 = $this->createForm(EmployerFormType::class, $emp);

        // Handle the request (populates the form with submitted data if any)
        $form1->handleRequest($request);

        // Check if the form is submitted and valid
        if ($form1->isSubmitted() && $form1->isValid()) {
            // Persist the Employer entity to the database
            $entityManager->persist($emp);
            // Flush the entity manager to save changes to the database
            $entityManager->flush();
        }

        // Render the form in the Twig template
        return $this->render('my/form.html.twig', [
            'frm' => $form1->createView(), // Render the form
        ]);
    }
}



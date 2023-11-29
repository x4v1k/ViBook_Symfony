<?php

namespace App\Controller;

use App\Entity\Home;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/aboutus', name: 'app_about_us')]
    public function aboutUs(): Response
    {
        $apartado = 'aboutUs';
        $mensaje = $this->entityManager->getRepository(Home::class)->findBy(['apartado' => $apartado]);

        return $this->render('message/index.html.twig', [
            'controller_name' => 'MessageController',
            'apartado' => $apartado,
            'mensajes' => $mensaje,
        ]);
    }

    #[Route('/contacto', name: 'app_contacto')]
    public function contacto(): Response
    {
        $apartado = 'contacto';
        $mensaje = $this->entityManager->getRepository(Home::class)->findBy(['apartado' => $apartado]);

        return $this->render('message/index.html.twig', [
            'controller_name' => 'MessageController',
            'apartado' => $apartado,
            'mensajes' => $mensaje,
        ]);
    }
}

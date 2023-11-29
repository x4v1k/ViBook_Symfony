<?php

// src/Controller/UsuarioController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;

class UsuarioController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/usuarios', name: 'listar_usuarios')]
    public function listarUsuarios(): Response
    {
        $usuarios = $this->entityManager->getRepository(Usuario::class)->findAll();

        return $this->json($usuarios);
    }
}

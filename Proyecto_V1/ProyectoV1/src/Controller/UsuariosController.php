<?php

namespace App\Controller;

use App\Entity\Usuarios;
use App\Form\UsuariosForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsuariosController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/usuarios', name: 'listar_usuarios')]
    public function listarUsuarios(): Response
    {
        $usuarios = $this->entityManager->getRepository(Usuarios::class)->findAll();

        return $this->render('usuarios/index.html.twig', [
            'controller_name' => 'UsuariosController',
            'usuarios' => $usuarios,
        ]);
    }

    #[Route('/usuarios/crear', name: 'crear_usuario', methods: ['GET', 'POST'])]
    public function crearUsuario(Request $request): Response
    {
        $usuario = new Usuarios();
        $form = $this->createForm(UsuariosForm::class, $usuario);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->entityManager->persist($usuario);
                $this->entityManager->flush();

                return $this->redirectToRoute('listar_usuarios');
            }
        }

        return $this->render('usuarios/crear.html.twig', [
            'controller_name' => 'UsuariosController',
            'form' => $form->createView(),
        ]);
    }
}

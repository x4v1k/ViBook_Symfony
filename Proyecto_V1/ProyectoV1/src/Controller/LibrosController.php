<?php

namespace App\Controller;

use App\Entity\Libros;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibrosController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/libros/listar', name: 'listar_libros', methods: ['GET'])]
    public function listarLibros(): JsonResponse
    {
        $libros = $this->entityManager->getRepository(Libros::class)->findAll();

        $librosData = [];

        foreach ($libros as $libro) {
            $librosData[] = [
                'isbn' => $libro->getIsbn(),
                'titulo' => $libro->getTitulo(),
                'autor' => $libro->getAutor(),
                'precio' => $libro->getPrecio(),
                'idGrupoEtiqueta' => $libro->getIdGrupoEtiqueta()->getIdGrupoEtiqueta(),
            ];
        }

        return $this->json(['libros' => $librosData], Response::HTTP_OK);
    }
    // ...

    #[Route('/libros/crear', name: 'crear_libro', methods: ['POST'])]
    public function crearLibro(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $libro = new Libros();
        $libro->setTitulo($data['titulo']);
        $libro->setAutor($data['autor']);
        $libro->setPrecio($data['precio']);

        // Asumiendo que 'idGrupoEtiqueta' está presente en los datos del formulario.
        $libro->setIdGrupoEtiqueta($data['idGrupoEtiqueta']);

        $this->entityManager->persist($libro);
        $this->entityManager->flush();

        return $this->json(['mensaje' => 'Libro creado correctamente'], Response::HTTP_OK);
    }

    #[Route('/libros/actualizar/{isbn}', name: 'actualizar_libro', methods: ['PUT'])]
    public function actualizarLibro(Request $request, int $isbn): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $libro = $this->entityManager->getRepository(Libros::class)->find($isbn);

        if (!$libro) {
            return $this->json(['error' => 'Libro no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $libro->setTitulo($data['titulo'] ?? $libro->getTitulo());
        $libro->setAutor($data['autor'] ?? $libro->getAutor());
        $libro->setPrecio($data['precio'] ?? $libro->getPrecio());

        // Asumiendo que 'idGrupoEtiqueta' está presente en los datos del formulario.
        $libro->setIdGrupoEtiqueta($data['idGrupoEtiqueta'] ?? $libro->getIdGrupoEtiqueta());

        $this->entityManager->flush();

        return $this->json(['mensaje' => 'Libro actualizado correctamente'], Response::HTTP_OK);
    }

    // ...


    #[Route('/libros/eliminar/{isbn}', name: 'eliminar_libro', methods: ['DELETE'])]
    public function eliminarLibro(int $isbn): JsonResponse
    {
        $libro = $this->entityManager->getRepository(Libros::class)->find($isbn);

        if (!$libro) {
            return $this->json(['error' => 'Libro no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($libro);
        $this->entityManager->flush();

        return $this->json(['mensaje' => 'Libro eliminado correctamente'], Response::HTTP_OK);
    }
}

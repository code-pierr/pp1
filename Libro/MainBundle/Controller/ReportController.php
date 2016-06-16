<?php

namespace Libro\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Libro\MainBundle\Entity\Usuario;
use Libro\MainBundle\Entity\Libro;

class ReportController extends Controller
{
    public function indexAction(Request $request)
    {
      $sesion = $request->getSession();
      $em = $this->getDoctrine()->getManager();
      if(!empty($sesion->get('id')))
      {
          // $todo = $em->getRepository('LibroMainBundle:Libro')->findAll();
          $usuario = $em->getRepository('LibroMainBundle:Usuario')->findOneById($sesion->get('id'));
          $query = $em->createQuery('
          SELECT l.fecha
          FROM LibroMainBundle:Libro l
          GROUP BY l.fecha
          ');
          $libros = $query->getResult();
          $query = $em->createQuery('
          SELECT l.id, COUNT(l.id)
          FROM LibroMainBundle:Libro l
          GROUP BY l.fecha
          ');
          $libro2 = $query->getResult();
          return $this->render('LibroMainBundle:Report:report1.html.twig', array('nombre' => $usuario->getNombre(),
          'libros' => $libros, 'libro2' => $libro2
        ));
      }
    }

}

 ?>

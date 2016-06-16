<?php

namespace Libro\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Libro\MainBundle\Entity\Usuario;
use Libro\MainBundle\Entity\Libro;

class ManageController extends Controller
{
    public function indexAction(Request $request)
    {
          $sesion = $request->getSession();
          $em = $this->getDoctrine()->getManager();
          if(!empty($sesion->get('id')))
          {
              $usuario = $em->getRepository('LibroMainBundle:Usuario')->findOneById($sesion->get('id'));
              $libros = $em->getRepository('LibroMainBundle:Libro')->findAll();
              return $this->render('LibroMainBundle:Manage:index.html.twig', array('nombre' => $usuario->getNombre(),
              'libros' =>$libros              
              ));
          }
          else
          {
            return $this->redirect($this->generateUrl('libro_main'));
          }
    }
}

 ?>

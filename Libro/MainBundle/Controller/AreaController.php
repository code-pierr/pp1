<?php

namespace Libro\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Libro\MainBundle\Entity\Usuario;
use Libro\MainBundle\Entity\Area;

class AreaController extends Controller
{
    public function indexAction(Request $request)
    {
          $sesion = $request->getSession();
          $em = $this->getDoctrine()->getManager();
          if(!empty($sesion->get('id')))
          {
              $usuario = $em->getRepository('LibroMainBundle:Usuario')->findOneById($sesion->get('id'));
              $area = $em->getRepository('LibroMainBundle:Area')->findAll();
              // $sesion->invalidate();
              // $sesion->clear();
              return $this->render('LibroMainBundle:Manage:area.html.twig', array('nombre' => $usuario->getNombre(),
              'area' => $area
              ));
          }
          else
          {
            return $this->redirect($this->generateUrl('libro_main'));
          }
    }
    public function deleteAction($id)
    {
      if($id)
      {
          $em = $this->getDoctrine()->getEntityManager();
          $area = $em->getRepository('LibroMainBundle:Area')->find($id);
          $em->remove($area);
          $em->flush();
          // $area = $em->getRepository('LibroMainBundle:Area')->findAll();
          // $sesion->invalidate();
          // $sesion->clear();
          // return $this->render('LibroMainBundle:Manage:area.html.twig', array('nombre' => $usuario->getNombre(),
          // 'area' => $area
          // ));
          return $this->redirect($this->generateUrl('libro_manage_area'));
      }
      else
      {
        return $this->redirect($this->generateUrl('libro_main'));
      }
    }

    public function updateAction(Request $request)
    {
      $id=$request->request->get("idArea");
      $nombre=$request->request->get("nombre");
      $encargado=$request->request->get("encargado");
      $telefono=$request->request->get("telefono");
      if(!empty($id))
      {
          $em = $this->getDoctrine()->getEntityManager();
          $idUpdate = $em->getRepository('LibroMainBundle:Area')->find($id);
          $idUpdate->setNombre($nombre);
          $idUpdate->setEncargado($encargado);
          $idUpdate->setTelefono($telefono);
          $em->persist($idUpdate);
          $em->flush();
          return $this->redirect($this->generateUrl('libro_manage_area'));
      }
      else
      {
        return $this->redirect($this->generateUrl('libro_main'));
      }
    }

    public function insertAction(Request $request)
    {
      $id=$request->request->get("idArea");
      $nombre=$request->request->get("nombre");
      $encargado=$request->request->get("encargado");
      $telefono=$request->request->get("telefono");
      if(!empty($id))
      {
          $area = new Area();
          $area->setId($id);
          $area->setNombre($nombre);
          $area->setEncargado($encargado);
          $area->setTelefono($telefono);
          $em = $this->getDoctrine()->getEntityManager();
          $em->persist($area);
          $em->flush();
          return $this->redirect($this->generateUrl('libro_manage_area'));
      }
      else
      {
        return $this->redirect($this->generateUrl('libro_main'));
      }
    }
}

 ?>

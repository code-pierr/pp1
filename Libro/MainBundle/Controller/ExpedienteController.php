<?php

namespace Libro\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Libro\MainBundle\Entity\Usuario;
use Libro\MainBundle\Entity\Expediente;
use Libro\MainBundle\Entity\Libro;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\File;

class ExpedienteController extends Controller
{
    public function indexAction(Request $request)
    {
          $sesion = $request->getSession();
          $em = $this->getDoctrine()->getManager();
          if(!empty($sesion->get('id')))
          {
              $usuario = $em->getRepository('LibroMainBundle:Usuario')->findOneById($sesion->get('id'));
              $expediente = $em->getRepository('LibroMainBundle:Expediente')->findAll();
              // $sesion->invalidate();
              // $sesion->clear();
              return $this->render('LibroMainBundle:Manage:expediente.html.twig', array('nombre' => $usuario->getNombre(),
              'expediente' => $expediente
              ));
          }
          else
          {
            return $this->redirect($this->generateUrl('libro_main'));
          }
    }
    public function downloadAction($id)
    {
      $item = $this->getDoctrine()->getRepository("LibroMainBundle:Expediente")->find($id);
      if(!$item)
      {
        throw $this->createNotFoundException("Error Processing Request", 1);
      }
      $pdfFile = stream_get_contents($item->getContenido());
      // return new Response(":".print_r($pdfFile));
      $response = new Response($pdfFile, 200, array('Content-Type' => 'application/pdf',
      'Content-Disposition' => 'attachment'
      ));
      return $response;
    }
    public function deleteAction($id)
    {
      if($id || $id == 0)
      {
          $em = $this->getDoctrine()->getEntityManager();
          $expediente = $em->getRepository('LibroMainBundle:Expediente')->findOneById($id);
          $eliminar = $em->getRepository('LibroMainBundle:Libro')->findOneByExpediente($id);
          if($eliminar || !empty($eliminar)){
            $eliminar->setEstado("anulado");
            $eliminar->setExpediente(NULL);
            $em->persist($eliminar);
            $em->flush();
          }
          $em->remove($expediente);
          $em->flush();
          return $this->redirect($this->generateUrl('libro_manage_expediente'));
      }
      else
      {
        return $this->redirect($this->generateUrl('libro_main'));
      }
    }

    public function updateAction(Request $request)
    {
      $id=$request->request->get("idExpediente");
      $fecha=$request->request->get("fecha");
      $fecha = str_replace(",", "", $fecha);
      $tipo=$request->request->get("tipo");
      $asunto=$request->request->get("asunto");
      if($request->files->get("contenido") != null){
        $contenido=file_get_contents($request->files->get("contenido"));
      }else{
        $contenido = null;
      }
      if(!empty($id))
      {
          $em = $this->getDoctrine()->getEntityManager();
          $idUpdate = $em->getRepository('LibroMainBundle:Expediente')->find($id);
          $idUpdate->setFecha(new \DateTime($fecha));
          $idUpdate->setAsunto($asunto);
          $idUpdate->setTipo($tipo);
          $idUpdate->setContenido($contenido);
          $em->persist($idUpdate);
          $em->flush();
          $actualizar = $em->getRepository('LibroMainBundle:Libro')->findOneByExpediente($id);
          if($actualizar->getExpediente()!=null){
            $actualizar->setAsunto($asunto);
            $em->persist($actualizar);
            $em->flush();
          }
          return $this->redirect($this->generateUrl('libro_manage_expediente'));
      }
      else
      {
        return $this->redirect($this->generateUrl('libro_main'));
      }
    }

    public function insertAction(Request $request)
    {
      $id=$request->request->get("idExpediente");
      $fecha=$request->request->get("fecha");
      $fecha = str_replace(",", "", $fecha);
      $tipo=$request->request->get("tipo");
      $asunto=$request->request->get("asunto");
      if($request->files->get("contenido") != null){
        $contenido=file_get_contents($request->files->get("contenido"));
      }else{
        $contenido = null;
      }
      // return new Response("".$fecha);

      if(!empty($id))
      {
          //expediente
          $expediente = new Expediente();
          $expediente->setId($id);
          $expediente->setFecha(new \DateTime($fecha));
          $expediente->setAsunto($asunto);
          $expediente->setTipo($tipo);
          $expediente->setContenido($contenido);
          $em = $this->getDoctrine()->getEntityManager();
          $em->persist($expediente);
          $em->flush();
          //libro
          $em = $this->getDoctrine()->getEntityManager();
          $expediente1 = $em->getRepository('LibroMainBundle:Expediente')->find($id);
          $user1 = $em->getRepository('LibroMainBundle:Usuario')->findOneById($request->getSession()->get('id'));
          $libro = new Libro();
          $libro->setFecha(new \DateTime());
          $libro->setAsunto($asunto);
          $libro->setEstado("validado");
          $libro->setExpediente($expediente1);
          $libro->setUsuario($user1);
          $em->persist($libro);
          $em->flush();
          return $this->redirect($this->generateUrl('libro_manage_expediente'));
      }
      else
      {
        return $this->redirect($this->generateUrl('libro_manage_expediente'));
      }
    }
}

 ?>

<?php

namespace Libro\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Libro\MainBundle\Entity\Usuario;
use Libro\MainBundle\Entity\Documento;
use Libro\MainBundle\Entity\Area;
use Libro\MainBundle\Entity\Expediente;
use Symfony\Component\Validator\Constraints\Date;

class DocumentoController extends Controller
{
    public function indexAction(Request $request)
    {
          $sesion = $request->getSession();
          $em = $this->getDoctrine()->getManager();
          if(!empty($sesion->get('id')))
          {
              $usuario = $em->getRepository('LibroMainBundle:Usuario')->findOneById($sesion->get('id'));
              $documento = $em->getRepository('LibroMainBundle:Documento')->findAll();
              $area = $em->getRepository('LibroMainBundle:Area')->findAll();
              $expediente = $em->getRepository('LibroMainBundle:Expediente')->findAll();
              // $sesion->invalidate();
              // $sesion->clear();
              return $this->render('LibroMainBundle:Manage:documento.html.twig', array('nombre' => $usuario->getNombre(),
              'documentos' => $documento,
              'areas' => $area,
              'expedientes' => $expediente
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
          $documento = $em->getRepository('LibroMainBundle:Documento')->find($id);
          $em->remove($documento);
          $em->flush();
          // $area = $em->getRepository('LibroMainBundle:Area')->findAll();
          // $sesion->invalidate();
          // $sesion->clear();
          // return $this->render('LibroMainBundle:Manage:area.html.twig', array('nombre' => $usuario->getNombre(),
          // 'area' => $area
          // ));
          return $this->redirect($this->generateUrl('libro_manage_documento'));
      }
      else
      {
        return $this->redirect($this->generateUrl('libro_main'));
      }
    }

    public function updateAction(Request $request)
    {
      $id=$request->request->get("idDocumento");
      $fecha=$request->request->get("fecha");
      $fecha = str_replace(",", "", $fecha);
      $tipoDoc=$request->request->get("tipoDoc");
      $remitente=$request->request->get("remitente");
      $destinatario=$request->request->get("destinatario");
      $asunto=$request->request->get("asunto");
      $descripcion=$request->request->get("descripcion");
      $expediente=$request->request->get("expediente");
      $area=$request->request->get("area");
    //   return new Response(
    //   $expediente." ".$area
    // );
      if(!empty($id))
      {
          $em = $this->getDoctrine()->getEntityManager();
          $idUpdate = $em->getRepository('LibroMainBundle:Documento')->find($id);
          $expedienteUpdate = $em->getRepository('LibroMainBundle:Expediente')->findOneById($expediente);
          $areaUpdate = $em->getRepository('LibroMainBundle:Area')->findOneById($area);
          $idUpdate->setArea(NULL);
          $idUpdate->setExpediente(NULL);
        //   return new Response(
        //   $expedienteUpdate->getId()
        // );
          $idUpdate->setFecha(new  \DateTime($fecha));
          $idUpdate->setTipoDoc($tipoDoc);
          $idUpdate->setDe($remitente);
          $idUpdate->setPara($destinatario);
          $idUpdate->setAsunto($asunto);
          $idUpdate->setDescripcion($descripcion);
          $idUpdate->setExpediente($expedienteUpdate);
          $idUpdate->setArea($areaUpdate);
          $em->persist($idUpdate);
          $em->flush();
          return $this->redirect($this->generateUrl('libro_manage_documento'));
      }
      else
      {
        return $this->redirect($this->generateUrl('libro_main'));
      }
    }

    public function insertAction(Request $request)
    {
      $id=$request->request->get("idDocumento");
      $fecha=$request->request->get("fecha");
      $fecha = str_replace(",", "", $fecha);
      $tipoDoc=$request->request->get("tipoDoc");
      $remitente=$request->request->get("remitente");
      $destinatario=$request->request->get("destinatario");
      $asunto=$request->request->get("asunto");
      $descripcion=$request->request->get("descripcion");
      $expediente=$request->request->get("expediente");
      $area=$request->request->get("area");
      if(!empty($id))
      {
          $em = $this->getDoctrine()->getEntityManager();
          $documento = new Documento();
          $expedienteUpdate = $em->getRepository('LibroMainBundle:Expediente')->find($expediente);
          $areaUpdate = $em->getRepository('LibroMainBundle:Area')->find($area);
          $documento->setId($id);
          $documento->setFecha(new  \DateTime($fecha));
          $documento->setTipoDoc($tipoDoc);
          $documento->setDe($remitente);
          $documento->setPara($destinatario);
          $documento->setAsunto($asunto);
          $documento->setDescripcion($descripcion);
          $documento->setExpediente($expedienteUpdate);
          $documento->setArea($areaUpdate);
          $em->persist($documento);
          $em->flush();
          return $this->redirect($this->generateUrl('libro_manage_documento'));
      }
      else
      {
        return $this->redirect($this->generateUrl('libro_main'));
      }
    }
}

 ?>

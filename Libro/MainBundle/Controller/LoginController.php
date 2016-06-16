<?php

namespace Libro\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Libro\MainBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{

public function indexAction(Request $request)
{
  $sesion = $request->getSession();
  $sesion->clear();
  $sesion->invalidate();
  return $this->render('LibroMainBundle:Security:login.html.twig');
}
  public function loginAction(Request $request)
  {
    $dni=$request->request->get("dni");
    $pass=$request->request->get("pass");
    $em = $this->getDoctrine()->getManager();
    $usuario = $em->getRepository('LibroMainBundle:Usuario')->findOneById($dni);
    if ($usuario && $pass==$usuario->getPassword()) {
        $sesion = $request->getSession();
        $sesion->set('id', $usuario);
         return $this->redirect($this->generateUrl("libro_manage"));
    }else {
      return $this->redirect($this->generateUrl("libro_main"));
    }
  }

  public function logoutAction(Request $request)
  {
      $sesion = $request->getSession();
      $sesion->clear();
      return $this->redirect($this->generateUrl("libro_main"));
  }

}


 ?>

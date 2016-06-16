<?php

namespace Libro\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PruebaController extends Controller
{
    public function indexAction()
    {
        return $this->render('LibroMainBundle:Manage:prueba.html.twig');
    }
    public function pruebaAction(Request $request)
    {
      $expe = $request->request->get('xp');
      return new Response(" ".$expe);
    }
}

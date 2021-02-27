<?php

namespace GestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use GestionBundle\Entity\Alumno;
use GestionBundle\Form\AlumnoType;
use Symfony\Component\HttpFoundation\Request;

class GestionController extends Controller
{

    /**
     * @Route("/home")
     */
    public function indexAction()
    {
        return $this->render('@Gestion/home.html.twig');
    }

    /**
     * @Route("/gestion/nuevoalumno", name="nuevo_alumno")
     */
    public function nuevoAlumnoAction()
    {
    	$alumno = new Alumno();
    	$route = $this->generateUrl('nuevo_alumno_procesar');
    	$form = $this->getFormAltaAlumno($alumno, $route);
        return $this->render('@Gestion/gestion/alumnoAlta.html.twig', ['label' => 'Nuevo', 'form' => $form->createView()]);
    }

    private function getFormAltaAlumno($alumno, $route)
    {
        return $this->createForm(AlumnoType::class, $alumno, ['action' => $route,'method' => 'POST']);
    }

    /**
     * @Route("/gestion/alumnoproc", name="nuevo_alumno_procesar", methods="POST")
     */
    public function procesarAltaAlumnoAction(Request $request)
    {
    	$alumno = new Alumno();
    	$route = $this->generateUrl('nuevo_alumno_procesar');
    	$form = $this->getFormAltaAlumno($alumno, $route);
    	$form->handleRequest($request);
    	if ($form->isValid())
    	{
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($alumno);
    		$em->flush();
            $this->addFlash(
                          'success',
                          'Alumno generado exitosamente!'
                      );
    		return $this->redirect($this->generateUrl('nuevo_alumno'));
    	}
    	return $this->render('@Gestion/gestion/alumnoAlta.html.twig', ['label' => 'Nuevo', 'form' => $form->createView()]);
    }

    /**
     * @Route("/gestion/listaalumnos", name="listar_alumnos")
     */
    public function listarAlumnosAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$alumnos = $em->getRepository(Alumno::class)->getAlumnosList();
    	return $this->render('@Gestion/gestion/alumnosLista.html.twig', ['alumnos' => $alumnos]);
    }

    /**
     * @Route("/gestion/editalumno/{id}", name="editar_alumno")
     */
    public function editarAlumnoAction($id)
    {
    	$alumno = $this->getDoctrine()->getManager()->find(Alumno::class, $id);
    	$route = $this->generateUrl('editar_alumno_procesar', ['id' => $id]);
    	$form = $this->getFormAltaAlumno($alumno, $route);
        return $this->render('@Gestion/gestion/alumnoAlta.html.twig', ['label' => 'Modificar', 'form' => $form->createView()]);
    }

    /**
     * @Route("/gestion/editproc/{id}", name="editar_alumno_procesar", methods="POST")
     */
    public function procesarEditarAlumnoAction($id, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$alumno = $em->find(Alumno::class, $id);
    	$route = $this->generateUrl('editar_alumno_procesar', ['id' => $id]);
    	$form = $this->getFormAltaAlumno($alumno, $route);
    	$form->handleRequest($request);
    	if ($form->isValid())
    	{
    		$em->flush();
            $this->addFlash(
                          'success',
                          'Los datos del alumno han sido modificados exitosamente!'
                      );
    		return $this->redirect($this->generateUrl('listar_alumnos'));
    	}
    	return $this->render('@Gestion/gestion/alumnoAlta.html.twig', ['label' => 'Modificar', 'form' => $form->createView()]);
    }
}

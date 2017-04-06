<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/04/17
 * Time: 15:08
 */

namespace Lch\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * Deletes an entity.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteAction(Request $request)
    {
        $class = $request->request->get('class');
        $id = $request->request->get('id');
        $route = $request->request->get('route');

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository($class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find entity to delete.');
        }

        try {
            $em->remove($entity);
            $em->flush();

            // Add success flash
            $this->addFlash('success', $this->get('translator')->trans('lch.components.list.item.flash.delete.success'));
        }
        catch(\Exception $exception) {
            $this->addFlash('success', $this->get('translator')->trans('lch.components.list.item.flash.delete.error', ['error' => $exception->getMessage()]));
        }

        return $this->redirectToRoute($route);
    }
}
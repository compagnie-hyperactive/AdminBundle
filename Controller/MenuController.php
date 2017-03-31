<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 29/03/17
 * Time: 16:57
 */

namespace Lch\AdminBundle\Controller;


use Lch\AdminBundle\Listener\Menu\MenusListSubscriber;
use Lch\MenuBundle\Entity\Menu;
use Lch\MenuBundle\Form\MenuType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends Controller
{
    /**
     * @return Response
     */
    public function listAction() {
        $menus = $this->getDoctrine()->getRepository('LchMenuBundle:Menu')->findAll();

        // Define list options
        $listOptions = [
            'entity' => [
                'name'  => MenusListSubscriber::ENTITY,
                'alias' => 'm'
            ],
            'fields' => [
                'title' => [
                    'label' => 'lch.admin.menu.form.fields.title.label'
                ]
            ],
            'baseRoute' => 'lch_admin_menu_',
            'actionForId' => 'edit'
        ];

        return $this->render('@LchAdmin/Menu/list.html.twig', [
            'menus' => $menus,
            'listOptions' => $listOptions
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function addAction(Request $request) {
        $menu = new Menu();

        $menuForm = $this
            ->createForm(MenuType::class, $menu)
            // Add create button
            ->add('create', SubmitType::class, [
                'label' => 'ipc.back.form.create.label'
            ])
        ;

        $menuForm->handleRequest($request);

        if($menuForm->isSubmitted() && $menuForm->isValid()) {
            try {
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($menu);
                $em->flush();
                $this->addFlash('success', $this->get('translator')->trans('lch.menu.form.flash.add.success'));

                return $this->redirectToRoute('lch_admin_menu_edit', ['id' => $menu->getId()]);
            }
            catch(Exception $e) {
                $this->addFlash('error', $this->get('translator')->trans('lch.menu.form.flash.add.error', ['error' => $e->getMessage()]));
            }
        } else if($menuForm->isSubmitted() && !$menuForm->isValid()) {
            $this->addFlash('error', $this->get('translator')->trans('lch.menu.form.flash.generic.error'));
        }
        
        return $this->render('@LchAdmin/Menu/add.html.twig', [
            'form' => $menuForm->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Menu $menu
     * @return Response
     */
    public function editAction(Request $request, Menu $menu) {

        $menuForm = $this
            ->createForm(MenuType::class, $menu)

            // Add Edit button
            ->add('edit', SubmitType::class, [
                'label' => 'ipc.back.form.edit.label',
                'attr' => [
                    'icon' => 'edit'
                ]
            ])
        ;
        $menuForm->handleRequest($request);

        if($menuForm->isSubmitted() && $menuForm->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($menu);
                $em->flush();
                $this->addFlash('success', $this->get('translator')->trans('lch.menu.form.flash.edit.success'));
            }
            catch(Exception $e) {
                $this->addFlash('error', $this->get('translator')->trans('lch.menu.form.flash.edit.error', ['error' => $e->getMessage()]));
            }
        }
        
        return $this->render('@LchAdmin/Menu/edit.html.twig', [
            'form' => $menuForm->createView()
        ]);
    }
}
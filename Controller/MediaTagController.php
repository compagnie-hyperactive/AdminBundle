<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 07/04/17
 * Time: 16:34
 */

namespace Lch\AdminBundle\Controller;


use Lch\AdminBundle\Controller\AdminController;
use Lch\AdminBundle\Form\MediaTagType;
use Lch\AdminBundle\Listener\Menu\TagsListSubscriber;
use Lch\MediaBundle\Entity\Tag;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MediaTagController extends AdminController
{
    /**
     * @return Response
     */
    public function listAction()
    {
        $tags = $this->getDoctrine()->getRepository('LchMediaBundle:Tag')->findAll();

        // Define list options
        $listOptions = [
            'entity' => [
                'name' => TagsListSubscriber::ENTITY,
                'class' => Tag::class,
                'alias' => 't'
            ],
            'fields' => [
                'name' => [
                    'label' => 'lch.admin.tag.form.fields.title.label'
                ]
            ],
            'baseRoute' => 'lch_admin_tag_',
            'actionForId' => 'edit'
        ];

        return $this->render('@LchAdmin/MediaTag/list.html.twig', [
            'tags' => $tags,
            'listOptions' => $listOptions
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function addAction(Request $request)
    {
        $tag = new Tag();

        $tagForm = $this
            ->createForm(MediaTagType::class, $tag)
            // Add create button
            ->add('create', SubmitType::class, [
                'label' => 'ipc.back.form.create.label'
            ]);

        $tagForm->handleRequest($request);

        if ($tagForm->isSubmitted() && $tagForm->isValid()) {
            try {

                $em = $this->getDoctrine()->getManager();
                $em->persist($tag);
                $em->flush();
                $this->addFlash('success', $this->get('translator')->trans('lch.admin.tag.form.flash.add.success'));

                return $this->redirectToRoute('lch_admin_tag_edit', ['id' => $tag->getId()]);
            } catch (\Exception $e) {
                $this->addFlash('error', $this->get('translator')->trans('lch.admin.tag.form.flash.add.error', ['error' => $e->getMessage()]));
            }
        } else if ($tagForm->isSubmitted() && !$tagForm->isValid()) {
            $this->addFlash('error', $this->get('translator')->trans('lch.admin.tag.form.flash.generic.error'));
        }

        return $this->render('@LchAdmin/MediaTag/add.html.twig', [
            'form' => $tagForm->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Tag $tag
     * @return Response
     */
    public function editAction(Request $request, Tag $tag)
    {

        $tagForm = $this
            ->createForm(MediaTagType::class, $tag)
            // Add Edit button
            ->add('edit', SubmitType::class, [
                'label' => 'ipc.back.form.edit.label',
                'attr' => [
                    'icon' => 'edit'
                ]
            ]);

        $tagForm->handleRequest($request);

        if ($tagForm->isSubmitted() && $tagForm->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();

                $em->persist($tag);
                $em->flush();
                $this->addFlash('success', $this->get('translator')->trans('lch.admin.menu.form.flash.edit.success'));
            } catch (\Exception $e) {
                $this->addFlash('error', $this->get('translator')->trans('lch.admin.menu.form.flash.edit.error', ['error' => $e->getMessage()]));
            }
        }

        return $this->render('@LchAdmin/Menu/edit.html.twig', [
            'form' => $tagForm->createView()
        ]);
    }
}
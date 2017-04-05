<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 05/04/17
 * Time: 10:42
 */

namespace Lch\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MediaLibraryController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function libraryAction(Request $request, string $type) {
        return $this->render('@LchAdmin/Media/Library/library.html.twig', [
            'type' => $type,
            'mediaTypes' => $this->getParameter('lch.media.types')
        ]);
    }
}
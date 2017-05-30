<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 05/04/17
 * Time: 10:42
 */

namespace Lch\AdminBundle\Controller;


use Lch\MediaBundle\Entity\Media;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MediaLibraryController extends Controller
{
    /**
     * @param Request $request
     * @param string $type
     * @return Response
     */
    public function libraryAction(Request $request, string $type = Media::ALL) {

        return $this->render('@LchAdmin/Media/Library/library.html.twig', [
            'type' => $type,
            'mediaTypes' => $this->getParameter('lch.media.types'),
            'popinMode' => $request->query->has('popinMode') ? $request->query->get('popinMode') : 0
        ]);
    }
}
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Album;
use App\Entity\Song;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Components\DurationComponent\Duration;

class AlbumController extends AbstractController
{
    /**
     * @Route("/albums/{token}", name="albums")
     */
    public function index($token = '')
    {
        // get album repository
        $repository = $this->getDoctrine()->getRepository(Album::class);
        
        // get all stored artists 
        if (!$token) {
            $albums = $repository->findAll();
        } else {
            $albums = $repository->findBy(['token' => $token]);
        }


        // iterate artist array and get artist albums
        foreach($albums as $key => $album) {
            $data[$key]['title'] = $album->getTitle();
            $data[$key]['token'] = $album->getToken();
            $data[$key]['songs'] = array_map(function($elem) {
                return [
                    'title' => $elem->title,
                    'length' => Duration::toSecond($elem->getLength())
                ];
            }, $album->getSong()->toArray());
        }

        return new JsonResponse(
            [
                'status' => 1,
                'data' => $data ?? []
            ],
            JsonResponse::HTTP_OK
        );
    }
}

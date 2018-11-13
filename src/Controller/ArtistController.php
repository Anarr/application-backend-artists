<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Artist;
use App\Entity\Album;

class ArtistController extends AbstractController
{
    /**
     * @Route("/artists", name="artists")
     */
    public function index()
    {

        $repository = $this->getDoctrine()->getRepository(Artist::class);
        
        $artists = $repository->findAll();
        foreach($artists as $key => $artist) {
            $data[$key]['name'] = $artist->getName();
            $data[$key]['token'] = $artist->getToken();
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

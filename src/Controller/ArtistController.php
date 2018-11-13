<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Artist;

class ArtistController extends AbstractController
{
    /**
     * @Route("/artists/{token}", name="artists")
     */
    public function index($token = '')
    {

        // get artist repository
        $repository = $this->getDoctrine()->getRepository(Artist::class);
        
        // get all stored artists 
        if (!$token) {
            $artists = $repository->findAll();
        } else {
            $artists = $repository->findBy(['token' => $token]);
        }


        // iterate artist array and get artist albums
        foreach($artists as $key => $artist) {
            
            $data[$key]['name'] = $artist->getName();
            $data[$key]['token'] = $artist->getToken();
            $data[$key]['albums'] = $artist->getAlbum()->toArray();
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

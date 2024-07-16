<?php

namespace App\Controller;

use App\Entity\Recherche;
use App\Repository\RechercheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api', name: 'app_api_recherche')]

class RechercheController extends AbstractController
{
    #[Route('/recherche', name: 'app_recherche',methods:['GET'])]
    public function getAllRecherche(SerializerInterface $serializerInterface,RechercheRepository $rechercheRepository)
    {
        $recherche=$rechercheRepository->findAll();
        $data = $serializerInterface->serialize($recherche, 'json', [
            'groups' => ['list']
        ]);
        return new Response($data, Response::HTTP_OK, [
            'Content-Type' => 'application/json'
        ]);
    }
    #[Route('/recherche', name: 'app_recherche_save',methods:['POST'])]
    public function saveRecherche(SerializerInterface $serializerInterface,Request $request,EntityManagerInterface $entityManagerInterface)
    {
        
        $data = json_decode($request->getContent(),true);
        if(!$data){
            $data=$request->request->all();
        }
        $recherche= new Recherche();
        $recherche->setNumeroLigne($data['numeroLigne'])
                  ->setNumeroReclammation($data['numeroReclammation']);
        $entityManagerInterface->persist($recherche);
        $entityManagerInterface->flush();
        $data = $serializerInterface->serialize($recherche, 'json', [
            'groups' => ['list']
        ]);
        return new Response($data, Response::HTTP_OK, [
            'Content-Type' => 'application/json'
        ]);
    }
    #[Route('/recherche/{numeroLigne}', name: 'app_recherche_one',methods:['GET'])]
    public function findForNumeroReclammation(string $numeroLigne,SerializerInterface $serializerInterface,RechercheRepository $rechercheRepository)
    {
        $recherche=$rechercheRepository->findBy(['numeroLigne'=>$numeroLigne]);
        $data = $serializerInterface->serialize($recherche, 'json', [
            'groups' => ['list']
        ]);
        return new Response($data, Response::HTTP_OK, [
            'Content-Type' => 'application/json'
        ]);
        
    }
    #[Route('/recherche/{numeroLigne}/{numeroReclammation}', name: 'app_recherche_two',methods:['GET'])]
    public function findForNumeroReclammationAndNumeroLigne(string $numeroLigne,string $numeroReclammation,SerializerInterface $serializerInterface,RechercheRepository $rechercheRepository): Response
    {
        $recherche=$rechercheRepository->findOneBy(['numeroReclammation'=>$numeroReclammation,'numeroLigne'=>$numeroLigne]);
        $data = $serializerInterface->serialize($recherche, 'json', [
            'groups' => ['list']
        ]);
        return new Response($data, Response::HTTP_OK, [
            'Content-Type' => 'application/json'
        ]);
    }

}

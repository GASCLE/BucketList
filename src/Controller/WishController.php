<?php

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{

    #[Route('/{id}', name: 'detail', requirements: ['id' => '\d+'])]
    public function detail(int $id, WishRepository $wishRepository): Response
    {
        $awish = $wishRepository->find($id);

        if(!$awish){
            throw $this->createNotFoundException("Oops ! Serie not found !");
        }

        return $this->render("Wish/detail.html.twig", [
           'awish' => $awish
        ]);
    }

    #[Route('/list', name: 'wish_list')]
    public function list(WishRepository $wishRepository): Response
    {
        $wishes = $wishRepository->findBy(["isPublished" => true], ["dateCreated" => 'DESC']);


        return $this->render("wish/list.html.twig",[
        'wishes' => $wishes
        ]);
    }
}

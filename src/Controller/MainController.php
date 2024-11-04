<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/main1', name: 'app_main1')]
    public function f1(): Response
    {
        return $this->render('main/index1.html.twig', [
            'controller_name' => 'MainController111111',
        ]);
    }

    #[Route('/main2', name: 'app_main2')]
    public function f2(): Response
    {
        $nom = "ISSA";
        $prenom = "Nader";
        $notes = ["algo"=>20, "reseau"=>15, "bd"=>12];
        return $this->render('main/index2.html.twig', [
            'nom'=> $nom,'prenom'=>$prenom,'notes'=>$notes
        ]);
    }
    #[Route('/main3', name: 'app_main3')]
    public function f3(): Response
    {
        return $this->render('main/index3.html.twig', [
            
        ]);
    }
}

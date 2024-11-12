<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit_liste')]
    public function liste(ProduitRepository $repos): Response
    {
        $titrePage = "Liste de tous les produits";
        $produits = $repos->findAll();
        
        //dd($produits);
        
        return $this->render('produit/liste.html.twig', [
            'produits'=> $produits,'titre' => $titrePage
        ]);
    }
    #[Route('/produit/{id}', name: 'app_produit_detail')]
    public function detail($id,ProduitRepository $repos): Response
    {
        //dd($id);
        
        $produit = $repos->find($id);
        if (!$produit) {
            throw $this->createNotFoundException(
                'Produit non trouve pour id '.$id
            );
        }
        
        //dd($produits);
        
        return $this->render('produit/detail.html.twig', ['produit'=>$produit
            
        ]);
    }
    #[Route('/produit/delete/{id}', name: 'app_produit_delete')]
    public function delete($id,ProduitRepository $repos,EntityManagerInterface $em): Response
    {
        //dd($id);
        
        $produit = $repos->find($id);
        if (!$produit) {
            throw $this->createNotFoundException(
                'Produit non trouve pour id '.$id
            );
        }
        $em->remove($produit);
        $em->flush();
        
        //dd($produits);
        
        return $this->render('produit/delete.html.twig', ['produit'=>$produit
            
        ]);
    }
}

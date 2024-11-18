<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    #[Route('/produits/categorie/{idCateg}', name: 'app_produit_liste_categorie')]
    public function listeparCategorie($idCateg,CategorieRepository $repos): Response
    {
        
        $categorie = $repos->find($idCateg);

        $produits = $categorie->getProduits();
        $titrePage = "Liste des produits de la categorie ".$categorie->getNom();
        //dd($produits);
        
        return $this->render('produit/liste.html.twig', [
            'produits'=> $produits,'titre' => $titrePage
        ]);
    }
    #[Route('/produit/{id}', name: 'app_produit_detail', requirements: ['id' => '\d+'])]
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
    #[Route('/produit/ajout', name: 'app_produit_ajout')]
    public function ajout(): Response
    {
        $produit = new Produit();
        $form=$this->createForm(ProduitType::class,$produit);

        
                
        return $this->render('produit/ajout.html.twig', ['form'=>$form]);
    }
}

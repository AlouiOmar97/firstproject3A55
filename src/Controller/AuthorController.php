<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{
    private  $authors = array( 

    array('id' => 321, 'picture' => '/images/Victor-Hugo.jpg','username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100), 
        
    array('id' => 22, 'picture' => '/images/william-shakespeare.jpg','username' => ' William Shakespeare', 'email' =>  ' william.shakespeare@gmail.com', 'nb_books' => 200 ), 
        
    array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg','username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300), 
        
        ); 

    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/author/list', name: 'app_author_list')]
    public function authorsList(AuthorRepository $authorRepository){
        $authorsDB= $authorRepository->findAll();
        return $this->render('author/list.html.twig',[
            'authors' => $authorsDB
        ]);
    }

    #[Route('/author/add', name: 'app_author_add')]
    public function addAuthor(EntityManagerInterface $em){
        $author= new Author();
        $author->setUsername('Ali');
        $author->setEmail('ali@gmail.com');
        $author->setPicture('/images/Taha_Hussein.jpg');
        $author->setNbBooks(250);
        $em->persist($author);
        $em->flush();
        dd($author);

    }

    #[Route('/author/delete/{id}', name: 'app_author_delete')]
    public function deleteAuthor($id, AuthorRepository $authorRepository, EntityManagerInterface $em){
        $author = $authorRepository->find($id);
        $em->remove($author);
        $em->flush();
        dd('Author deleted');
    }

    #[Route('/author/details/{id}', name: 'app_author_details')]
    public function authorDetails($id, AuthorRepository $authorRepository){
        //$author= $this->authors[ $id -1];
        $author= $authorRepository->find($id);
        return $this->render('author/details.html.twig',[
            'author' => $author
        ]);
    }

    #[Route('/author/{name}', name: 'app_author_name')]
    public function authorName($name){
        return $this->render('author/show.html.twig',[
            'name' => $name
        ]);
    }
}

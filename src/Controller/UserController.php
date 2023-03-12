<?php

namespace App\Controller;

use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{   
    // Crear usuarios.
    #[Route('/create/user', name: 'createUser')]
    public function insertUser(Request $request, EntityManagerInterface $doctrine, UserPasswordHasherInterface $hasher) {
        // Creamos el formulario y le indicamos los parametros en la carpeta form.
        $form = $this-> createForm(UserType::class);
        $form-> handleRequest($request);
        // Esto siempre es igual en todos los formularios de php.
        if($form-> isSubmitted() && $form-> isValid()) {
            // Tenemos que guardarlo en base de datos.
            $user = $form-> getData();
            $password = $user -> getPassword();
            $cifrado = $hasher-> hashPassword($user, $password);
            $user -> setPassword($cifrado);
            $doctrine-> persist($user);
            $doctrine-> flush();
            $this-> addFlash('success', 'Usuario insertado correctamente');
            return $this-> redirectToRoute('listMotos');
        }
        return $this-> renderForm('user/createUser.html.twig', [
            'userForm'=> $form
        ]);
    }

    #[Route('/create/admin', name: 'createAdmin')]
    public function insertAdmin(Request $request, EntityManagerInterface $doctrine, UserPasswordHasherInterface $hasher) {
        // Creamos el formulario y le indicamos los parametros en la carpeta form.
        $form = $this-> createForm(UserType::class);
        $form-> handleRequest($request);
        // Esto siempre es igual en todos los formularios de php.
        if($form-> isSubmitted() && $form-> isValid()) {
            // Tenemos que guardarlo en base de datos.
            $user = $form-> getData();
            $password = $user -> getPassword();
            $cifrado = $hasher-> hashPassword($user, $password);
            $user -> setPassword($cifrado);
            $user -> setRoles(['ROLE_ADMIN', 'ROLE_USER']);
            $doctrine-> persist($user);
            $doctrine-> flush();
            $this-> addFlash('success', 'Usuario insertado correctamente');
            return $this-> redirectToRoute('listMotos');
        }
        return $this-> renderForm('user/createUser.html.twig', [
            'userForm'=> $form
        ]);
    }
}

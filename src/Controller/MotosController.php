<?php

// Namespace.
namespace App\Controller;

use App\Entity\Moto;
use App\Entity\Tipo;
use App\Form\MotoType;
use App\Form\SearchType;
use App\Manager\Manager;
use App\Manager\MotoManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

// Creamos la clase class que tiene que ser igual que el nombre de la clase.
                                // Como heredamos de twig utlizamos abstractController.
class MotosController extends AbstractController{

    // Vamos a mostrar las motos con doctrine.
    #[Route('/motos', name:'listMotos')]
    public function listMotos(EntityManagerInterface $doctrine, Request $request){
        $form = $this-> createForm(SearchType::class);
        $form-> handleRequest($request);
        // Esto siempre es igual en todos los formularios de php.
        if($form-> isSubmitted() && $form-> isValid()) {
            // Tenemos que guardarlo en base de datos.
            $moto = $form-> get('moto')->getData();
            return $this->redirectToRoute('showMotos', ['id'=>$moto->getId()]);
        }

        // Para hacer consulatas tenemos coger de el repositorio la tabla sobre la queremos hacer la consulta.
        $repositorio=$doctrine->getRepository(Moto::class);
                            // findAll para traer todo.
        $motos=$repositorio->findAll();

        return $this->render('motos/listMotos.html.twig', ['motos' => $motos, 'searchForm'=>$form]);
    }
                // Añadimos el id.
    #[Route('/moto/{id}', name:'showMotos')]
    public function showMotos(EntityManagerInterface $doctrine, $id ){
        $repositorio=$doctrine->getRepository(Moto::class);
                            // Para traer uno.
                                // Traemos el id.
        $moto=$repositorio->find($id);

        return $this->render('motos/showMotos.html.twig', ['moto' => $moto]);
    }

    // Para crear datos para la base de datos.
    #[Route('/new/moto')]
                        // En cada funcion donde utilicemos doctrine le tenemos que pasar como argumento el servicio de doctrine.
                                    // Se convova como primer valor y como se gundo se declara una variable.
    public function newMotos(EntityManagerInterface $doctrine){
        // Tenemos que crear los objetos de tipo moto.
        $moto1= new Moto();
        // Creamos los atributos.
        $moto1->setMarca("Ducati");
        $moto1->setModelo("696");
        $moto1->setCv("80");
        $moto1->setCilindrada("696");
        $moto1->setColor("Amarillo");
        $moto1->setImg("https://www.motofichas.com/images/phocagallery/Ducati_Motor_Holding_SpA/Monster_696/Monster_696/ducati_monster_696_+.jpg");
        
        $moto2= new Moto();
        $moto2->setMarca("kymco");
        $moto2->setModelo("XCITING S 400");
        $moto2->setCv("36");
        $moto2->setCilindrada("400");
        $moto2->setColor("Azul");
        $moto2->setImg("https://www.motofichas.com/images/phocagallery/Kwang_Yang_Motor_Co/xciting-s-400-2018/02-kymco-xciting-s-400-2018-perfil-azul.jpg");
        
        $moto3= new Moto();
        $moto3->setMarca("Honda");
        $moto3->setModelo("SH");
        $moto3->setCv("12");
        $moto3->setCilindrada("125");
        $moto3->setColor("Negro");
        $moto3->setImg("https://www.motofichas.com/images/phocagallery/Honda/SH125i_2017/08-honda-sh125-2019-estatica-negro.jpg");
       
        $moto4= new Moto();
        $moto4->setMarca("Ducati");
        $moto4->setModelo("696");
        $moto4->setCv("80");
        $moto4->setCilindrada("696");
        $moto4->setColor("Roja");
        $moto4->setImg("https://www.motofichas.com/images/phocagallery/Ducati_Motor_Holding_SpA/Monster_696/Monster_696/ducati_monster_696_+.jpg");
        
        $moto5= new Moto();
        $moto5->setMarca("Honda");
        $moto5->setModelo("AfricaTwin");
        $moto5->setCv("1084");
        $moto5->setCilindrada("696");
        $moto5->setColor("Blanca");
        $moto5->setImg("https://www.motofichas.com/images/phocagallery/Honda/africa-twin-adventure-sports-2022/01-honda-africa-twin-adventure-sports-2022-estudio-blanco.jpg");
       
        $moto6= new Moto();
        $moto6->setMarca("Yamaha");
        $moto6->setModelo("MT-07");
        $moto6->setCv("73");
        $moto6->setCilindrada("686");
        $moto6->setColor("Azul");
        $moto6->setImg("https://www.motofichas.com/images/phocagallery/yamaha/mt-07-2023/01-yamaha-mt-07-2023-estudio-gris-cyan.jpg");
        
        $moto7= new Moto();
        $moto7->setMarca("Yamaha");
        $moto7->setModelo("Tenere");
        $moto7->setCv("73");
        $moto7->setCilindrada("686");
        $moto7->setColor("Blanca");
        $moto7->setImg("https://www.motofichas.com/images/phocagallery/yamaha/tenere-700-rally-edition-2023/01-yamaha-tenere-700-rally-edition-2023-estudio-blanco.jpg");
      
        $moto8= new Moto();
        $moto8->setMarca("Ducati");
        $moto8->setModelo("Panigale V4");
        $moto8->setCv("215");
        $moto8->setCilindrada("1103");
        $moto8->setColor("Rojo");
        $moto8->setImg("https://www.motofichas.com/images/phocagallery/ducati/panigale-v4-s-2023/01-ducati-panigale-v4-s-2023-estudio-rojo-01.jpg");
       
        $moto9= new Moto();
        $moto9->setMarca("Harley-Davison");
        $moto9->setModelo("Fat-Bob");
        $moto9->setCv("93");
        $moto9->setCilindrada("1868");
        $moto9->setColor("Negra");
        $moto9->setImg("https://www.motofichas.com/images/phocagallery/Harley-Davidson/fat-bob-2023/01-harley-davidson-fat-bob-2023-estudio-gris-01.jpg");
        
        $moto10= new Moto();
        $moto10->setMarca("Yamaha");
        $moto10->setModelo("T-Max");
        $moto10->setCv("47");
        $moto10->setCilindrada("560");
        $moto10->setColor("Negro");
        $moto10->setImg("https://www.motofichas.com/images/phocagallery/yamaha/tmax-tech-max-2022/06-yamaha-tmax-tech-max-2022-estudio-gris.jpg");
        
        
        
        // Añadimos tipos.
        $tipo1 = new Tipo();
        $tipo1-> setNombre("Scooter");

        $tipo2 = new Tipo();
        $tipo2-> setNombre("Naked");

        $tipo3 = new Tipo();
        $tipo3-> setNombre("Trail");

        $tipo4 = new Tipo();
        $tipo4-> setNombre("Deportivas");

        $tipo5 = new Tipo();
        $tipo5-> setNombre("Clasica");

        $tipo6 = new Tipo();
        $tipo6-> setNombre("Custom");

        $tipo7 = new Tipo();
        $tipo7-> setNombre("CafeRacer");

        $tipo8 = new Tipo();
        $tipo8-> setNombre("Scrambler");

        $tipo9 = new Tipo();
        $tipo9-> setNombre("Touring");

        $tipo10 = new Tipo();
        $tipo10-> setNombre("Enduro");

        $tipo11 = new Tipo();
        $tipo11-> setNombre("Motocross");

        $tipo12 = new Tipo();
        $tipo12-> setNombre("Trial");

        $tipo13 = new Tipo();
        $tipo13-> setNombre("Rally");

        $tipo14 = new Tipo();
        $tipo14-> setNombre("Supermotard");

        // Relaccionamos los tipos.
        $moto1 -> addTipo($tipo1);
        $moto2 -> addTipo($tipo2);
        $moto3 -> addTipo($tipo3);
        $moto4 -> addTipo($tipo4);
        $moto5 -> addTipo($tipo5);
        $moto6 -> addTipo($tipo6);
        $moto7 -> addTipo($tipo7);
        $moto8 -> addTipo($tipo8);
        $moto9 -> addTipo($tipo9);
        $moto10 -> addTipo($tipo10);

        // Tenemos que indicarle a dorctrine que existen, lo hacemos con persiste.
        $doctrine->persist($moto1);
        $doctrine->persist($moto2);
        $doctrine->persist($moto3);
        $doctrine->persist($moto4);
        $doctrine->persist($moto5);
        $doctrine->persist($moto6);
        $doctrine->persist($moto7);
        $doctrine->persist($moto8);
        $doctrine->persist($moto9);
        $doctrine->persist($moto10);

        $doctrine->persist($tipo1);
        $doctrine->persist($tipo2);
        $doctrine->persist($tipo3);
        $doctrine->persist($tipo4);
        $doctrine->persist($tipo5);
        $doctrine->persist($tipo6);
        $doctrine->persist($tipo7);
        $doctrine->persist($tipo8);
        $doctrine->persist($tipo9);
        $doctrine->persist($tipo10);

        // Hacemos el flush para mandarlo a base de datos.
        $doctrine->flush();
        
        // Para comprobar si tenemos error y nos devuelve un mensaje en pantalla.
        return new Response("Motos insertadas correctamente");
    }
    // Ruta para crear un formulario.
    #[Route('/insert/moto', name: 'inserMoto')]
    public function insertMoto(Request $request, EntityManagerInterface $doctrine, MotoManager $manager) {
        // Creamos el formulario y le indicamos los parametros en la carpeta form.
        $form = $this-> createForm(MotoType::class);
        $form-> handleRequest($request);
        // Esto siempre es igual en todos los formularios de php.
        if($form-> isSubmitted() && $form-> isValid()) {
            // Tenemos que guardarlo en base de datos.
            $moto = $form-> getData();
            $motoImg = $form->get('imgMoto') -> getData();
            if($motoImg){
                $bikeImg = $manager->load($motoImg, $this->getParameter('kernel.project_dir').'/public/img' );
                $moto -> setImg('/img/'.$bikeImg);
            }
            $doctrine-> persist($moto);
            $doctrine-> flush();
            $this-> addFlash('success', 'Moto insertada correctamente');
            return $this-> redirectToRoute('listMotos');
        }
        return $this-> renderForm('motos/createMotos.html.twig', [
            'motoForm'=> $form
        ]);
    }
    // Editar motos, se genera igual que crear pero añadiendo un id para identificar la moto que queremos editar.
    #[Route('/edit/moto/{id}', name: 'editMoto')]
    public function editMoto(Request $request, EntityManagerInterface $doctrine, $id) {
        // Buscamos la moto que queremos editar.
        $repositorio=$doctrine->getRepository(Moto::class);
        // Para traer uno.
            // Traemos el id.
        $moto=$repositorio->find($id);
        // Creamos el formulario y le indicamos los parametros en la carpeta form.
        $form = $this-> createForm(MotoType::class, $moto);
        $form-> handleRequest($request);
        // Esto siempre es igual en todos los formularios de php.
        if($form-> isSubmitted() && $form-> isValid()) {
            // Tenemos que guardarlo en base de datos.
            $moto = $form-> getData();
            $doctrine-> persist($moto);
            $doctrine-> flush();
            $this-> addFlash('success', 'Moto insertada correctamente');
            return $this-> redirectToRoute('listMotos');
        }
        return $this-> renderForm('motos/createMotos.html.twig', [
            'motoForm'=> $form
        ]);
    }
    
    // Borrar.

    // Para controlar el adimistrador.
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/delete/moto/{id}', name:'deleteMoto')]
    public function deleteMotos(EntityManagerInterface $doctrine, $id ){
        $repositorio=$doctrine->getRepository(Moto::class);
                            // Para traer uno.
                                // Traemos el id.
        $moto=$repositorio->find($id);
        $doctrine->remove($moto);
        $doctrine->flush();
        $this->addFlash('success', 'Moto Borrada Correctamente');
        return $this->redirectToRoute('listMotos');
    }
}
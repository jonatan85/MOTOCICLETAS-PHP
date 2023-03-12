<?php

// Namespace.
namespace App\Controller;

use App\Entity\Moto;
use App\Entity\Tipo;
use App\Form\MotoType;
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
    // Tipamos el tipo de funcion publica, privada o *estatica*
    // Para asigar una ruta a la funcion #[Route())].
    // #[Route('/moto')]
    // public function showMotos(){
    //     // Datos para mostrar los campos de la moto.
    //     $moto = [
    //         'marca' => 'Ducati',
    //         'modelo' => '696',
    //         'cv' => '80',
    //         'cilindrada' => '696',
    //         'color' => 'Amarilla',
    //         'img' => 'https://www.motofichas.com/images/phocagallery/Ducati_Motor_Holding_SpA/Monster_696/Monster_696/ducati_monster_696_+.jpg'
    //     ];
    //     // Tenemos que crear la plantilla twig en templates.
    //     // Para utililazar la plantilla twig le pasamos la ubicacion de la carpeta motos y entre un array y comillas motos con la variable de $motos.
    //     return $this->render('motos/showMotos.html.twig', ['moto' => $moto]);
    // }
    // Creamos una lista con las motos.
    // #[Route('/motos', name:'listMotos')]
    // public function listMotos(){
    //     $motos = [
    //         [

    //             'marca' => 'Ducati',
    //             'modelo' => '696',
    //             'cv' => '80',
    //             'cilindrada' => '696',
    //             'color' => 'Amarilla',
    //             'img' => 'https://www.motofichas.com/images/phocagallery/Ducati_Motor_Holding_SpA/Monster_696/Monster_696/ducati_monster_696_+.jpg'
    //         ],
    //         [

    //             'marca' => 'Honda',
    //             'modelo' => 'AfricaTwin',
    //             'cv' => '101',
    //             'cilindrada' => '1084',
    //             'color' => 'Blanca',
    //             'img' => 'https://www.motofichas.com/images/phocagallery/Honda/africa-twin-adventure-sports-2022/01-honda-africa-twin-adventure-sports-2022-estudio-blanco.jpg'
    //         ],
    //         [

    //             'marca' => 'Yamaha',
    //             'modelo' => 'MT-07',
    //             'cv' => '73',
    //             'cilindrada' => '689',
    //             'color' => 'Azul',
    //             'img' => 'https://www.motofichas.com/images/phocagallery/yamaha/mt-07-2023/01-yamaha-mt-07-2023-estudio-gris-cyan.jpg'
    //         ],
    //         [

    //             'marca' => 'Yamaha',
    //             'modelo' => 'Tenere',
    //             'cv' => '73',
    //             'cilindrada' => '689',
    //             'color' => 'Blanca',
    //             'img' => 'https://www.motofichas.com/images/phocagallery/yamaha/tenere-700-rally-edition-2023/01-yamaha-tenere-700-rally-edition-2023-estudio-blanco.jpg'
    //         ],
    //         [

    //             'marca' => 'Ducati',
    //             'modelo' => 'Panigale V4',
    //             'cv' => '215',
    //             'cilindrada' => '1103',
    //             'color' => 'Rojo',
    //             'img' => 'https://www.motofichas.com/images/phocagallery/ducati/panigale-v4-s-2023/01-ducati-panigale-v4-s-2023-estudio-rojo-01.jpg'
    //         ],
    //         [

    //             'marca' => 'Harley-Davison',
    //             'modelo' => 'Fat-Bob',
    //             'cv' => '93',
    //             'cilindrada' => '1868',
    //             'color' => 'Negra',
    //             'img' => 'https://www.motofichas.com/images/phocagallery/Harley-Davidson/fat-bob-2023/01-harley-davidson-fat-bob-2023-estudio-gris-01.jpg'
    //         ],
    //         [

    //             'marca' => 'Yamaha',
    //             'modelo' => 'T-Max',
    //             'cv' => '47',
    //             'cilindrada' => '560',
    //             'color' => 'Negro',
    //             'img' => 'https://www.motofichas.com/images/phocagallery/yamaha/tmax-tech-max-2022/06-yamaha-tmax-tech-max-2022-estudio-gris.jpg'
    //         ],
    //         [

    //             'marca' => 'Kymco',
    //             'modelo' => 'XCITING S 400',
    //             'cv' => '36',
    //             'cilindrada' => '399',
    //             'color' => 'Azul',
    //             'img' => 'https://www.motofichas.com/images/phocagallery/Kwang_Yang_Motor_Co/xciting-s-400-2018/02-kymco-xciting-s-400-2018-perfil-azul.jpg'
    //         ],
    //         [

    //             'marca' => 'Honda',
    //             'modelo' => 'SH',
    //             'cv' => '12',
    //             'cilindrada' => '125',
    //             'color' => 'Negro',
    //             'img' => 'https://www.motofichas.com/images/phocagallery/Honda/SH125i_2017/08-honda-sh125-2019-estatica-negro.jpg'
    //         ]
    //     ];
    //     return $this->render('motos/listMotos.html.twig', ['motos' => $motos]);
    // }

    // Vamos a mostrar las motos con doctrine.
    #[Route('/motos', name:'listMotos')]
    public function listMotos(EntityManagerInterface $doctrine){
        // Para hacer consulatas tenemos coger de el repositorio la tabla sobre la queremos hacer la consulta.
        $repositorio=$doctrine->getRepository(Moto::class);
                            // findAll para traer todo.
        $motos=$repositorio->findAll();

        return $this->render('motos/listMotos.html.twig', ['motos' => $motos]);
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

        // Tenemos que indicarle a dorctrine que existen, lo hacemos con persiste.
        $doctrine->persist($moto1);
        $doctrine->persist($moto2);
        $doctrine->persist($moto3);

        $doctrine->persist($tipo1);
        $doctrine->persist($tipo2);
        $doctrine->persist($tipo3);

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
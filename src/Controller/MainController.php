<?php
    //https://www.youtube.com/watch?v=Rfz4jioNedY
    //https://docs.google.com/document/d/15il1-hlNTfMHlCDIpqedpLNZd_poE3DBHzSLFa6AN4Y/edit?pli=1
    namespace App\Controller;

    use App\Entity\Notes;
    use App\Form\NotesType;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;

    class MainController extends AbstractController
    {
        /**
         * @Route("/", name="index")
         */
        public function index(Request $request)
        {
            $em=$this->getDoctrine()->getManager();

            $note=new Notes();
            $form=$this->createForm(NotesType::class, $note);
            $form->handleRequest($request);
            //  dump($request);  die();
               if($form->isSubmitted() && $form->isValid()) {
                   $data=$form->getData();
//                   dump($data);
                   $em->persist($note);
                   $em->flush();
               }
            return $this->render('main/index.html.twig', [
                'controller_name'=>'MainController',
                'form'           =>$form->createView()
            ]);
        }
    }

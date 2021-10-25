<?php

namespace App\Controller;

use App\Form\ContactType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer /*MailerInterface $mailer*/)
    {
        $title = "Formulaire de contact";
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            //on envoie le mail
            $message = (new \Swift_Message('Nouveau message'))
                //on attribue l'expediteur
                ->setFrom($contact['email'])

                //destinataire
                ->setTo('loann.bourdier@yahoo.fr')

                //cree messsage avec twig
                ->setBody(
                    $this->renderView(
                        'email/infoMail.html.twig', compact('contact')
                    ),
                    'text/html'
                )
            ;

            //on envoie le message
            $mailer->send($message);

            $this->addFlash('message', 'Le message a bien été envoyé');
            return $this->redirectToRoute('home');
        }

        /*$form = $this->createFormBuilder()
            ->add('from', EmailType::class)
            ->add('message', TextareaType::class)
            ->add('send', SubmitType::class)
            ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            dump($data);
            $message = \SwiftMailer::newInstance()
                ->setSubject('Support From Submission')
                ->setFrom($data['from'])
                ->setTo('bkivb@olnfvli.com')
                ->setBody(
                    $form->getData()['message'],
                    'text/plain'
                )
            ;

            $this->get('mailer')->send($message);
        }*/
        

        return $this->render('contact/contact.html.twig', [
            //'our_form' => $form->createView(),
            'title' => $title,
            'contactForm' => $form->createView()
        ]);
    }    
}
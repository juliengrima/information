<?php

namespace App\Controller;

use App\Entity\Service;
use App\Entity\Data;
use App\Form\ServiceType;
use App\Form\ServiceTypeEdit;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/service')]
final class ServiceController extends AbstractController
{
    #[Route(name: 'app_service_index', methods: ['GET'])]
    public function index(ServiceRepository $serviceRepository): Response
    {
        return $this->render('service/index.html.twig', [
            'services' => $serviceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_service_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $service = new Service();

        // Créer une nouvelle Data et la lier au Service
        $data = new Data();
        $data->setService($service);
        $service->setData($data);

        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($service);
            $entityManager->flush();

            return $this->redirectToRoute('app_service_index');
        }

        return $this->render('service/new.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_service_show', methods: ['GET'])]
    public function show(Service $service): Response
    {
        // Récupérer les agents associés au service
        $agents = $service->getAgents(); // <- ex getAgents() après refacto (pas getService())

        // Grouper par téléphone
        $groupedPhones = [];
        foreach ($agents as $agent) {
            $phone = $agent->getPhone();
            if ($phone) {
                $phoneId = $phone->getId();
                if (!isset($groupedPhones[$phoneId])) {
                    $groupedPhones[$phoneId] = [
                        'phone' => $phone,
                        'agents' => [],
                    ];
                }
                $groupedPhones[$phoneId]['agents'][] = $agent;
            }
        }

        return $this->render('service/show.html.twig', [
            'service' => $service,
            'groupedPhones' => $groupedPhones,
        ]);
    }

    #[Route('/service/{id}/update-data', name: 'app_service_update_data', methods: ['POST'])]
    public function updateData(Request $request, Service $service, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!$service->getData()) {
            $serviceData = new Data();
            $serviceData->setService($service);
            $service->setData($serviceData);
            $em->persist($serviceData);
        }

        $service->getData()->setServiceData($data['service_data'] ?? '');
        $em->flush();

        return new JsonResponse(['status' => 'ok']);
    }

    #[Route('/{id}/edit', name: 'app_service_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Service $service, EntityManagerInterface $entityManager): Response
    {
        // Si le Service n'a pas encore de Data liée
        if (!$service->getData()) {
            $data = new Data();
            $data->setService($service);
            $service->setData($data);
        }

        $form = $this->createForm(ServiceTypeEdit::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            dump($form->getData());

            return $this->redirectToRoute('app_service_index');
        }

        return $this->render('service/edit.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_service_delete', methods: ['POST'])]
    public function delete(Request $request, Service $service, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$service->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($service);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
    }
}

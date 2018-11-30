<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Project;
use App\Entity\RequestEntity;
use App\Entity\Product;

class ProjectController extends FOSRestController
{
    /**
     * Add Project
     * @Rest\Post("/project/add")
     * @param Request $request
     * @return View
     *
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     type="string",
     *     description="Data Form",
     *     required=true,
     *     @SWG\Schema(
     *         type="object",
     *         @SWG\Property(property="name", type="string", example="Name", description="Name"),
     *         @SWG\Property(property="product_id", type="integer", example="1", description="Product ID"),
     *         @SWG\Property(property="price", type="integer", example="400", description="Price"),
     *         @SWG\Property(property="description", type="string", example="Description", description="Description"),
     *         @SWG\Property(property="start_date", type="string", example="2018-09-12 12:00:00", description="Start Date"),
     *         @SWG\Property(property="end_date", type="string", example="2018-09-14 22:00:00", description="End Date"),
     *     )
     * )
     * @SWG\Response(response=200, description="Project created")
     * @SWG\Tag(name="Project")
     * @Security(name="Bearer")
     */
    public function addProject(Request $request): View
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($request->get('product_id'));

        $project = new Project();
        $project->setName($request->get('name'));
        $project->setProduct($product);
        $project->setPrice($request->get('price'));
        $project->setDescription($request->get('description'));
        $project->setStartDate(\DateTime::createFromFormat('Y-m-d H:i:s', $request->get('start_date')));
        $project->setEndDate(\DateTime::createFromFormat('Y-m-d H:i:s', $request->get('end_date')));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($project);
        $entityManager->flush();

        return View::create($project, Response::HTTP_CREATED);
    }

    /**
     * Show Project
     * @Rest\Get("/project/{id}/show")
     *
     * @SWG\Parameter(name="id", in="path", type="integer", description="Project ID")
     * @SWG\Response(response=200, description="Project displayed")
     * @SWG\Tag(name="Project")
     * @Security(name="Bearer")
     */
    public function showProject(Project $project)
    {
        return $project;
    }

    /**
     * Make Request
     * @Rest\Get("/project/create/{id}/request")
     * @return View
     *
     * @SWG\Parameter(name="id", in="path", type="integer", description="Request ID")
     * @SWG\Response(response=200, description="Project created from request")
     * @SWG\Tag(name="Project")
     * @Security(name="Bearer")
     */
    public function makeRequest(RequestEntity $requestEntity): View
    {
        $project = new Project();
        $project->setName($requestEntity->getName());
        $project->setProduct($requestEntity->getProduct());
        $project->setPrice($requestEntity->getPrice());
        $project->setDescription($requestEntity->getDescription());
        $project->setStartDate($requestEntity->getStartDate());
        $project->setEndDate($requestEntity->getEndDate());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($project);
        $entityManager->flush();

        return View::create($project, Response::HTTP_CREATED);
    }
}

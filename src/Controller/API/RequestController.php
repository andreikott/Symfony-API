<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\RequestEntity;
use App\Entity\Product;

class RequestController extends FOSRestController
{
    /**
     * Add Request
     * @Rest\Post("/request/add")
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
     * @SWG\Response(response=200, description="Request created")
     * @SWG\Tag(name="Request")
     * @Security(name="Bearer")
     */
    public function addRequest(Request $request): View
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($request->get('product_id'));

        $requestEntity = new RequestEntity();
        $requestEntity->setName($request->get('name'));
        $requestEntity->setProduct($product);
        $requestEntity->setPrice($request->get('price'));
        $requestEntity->setDescription($request->get('description'));
        $requestEntity->setStartDate(\DateTime::createFromFormat('Y-m-d H:i:s', $request->get('start_date')));
        $requestEntity->setEndDate(\DateTime::createFromFormat('Y-m-d H:i:s', $request->get('end_date')));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($requestEntity);
        $entityManager->flush();

        return View::create($requestEntity, Response::HTTP_CREATED);
    }

    /**
     * Show Request
     * @Rest\Get("/request/{id}/show")
     *
     * @SWG\Parameter(name="id", in="path", type="integer", description="Request ID")
     * @SWG\Response(response=200, description="Request displayed")
     * @SWG\Tag(name="Request")
     * @Security(name="Bearer")
     */
    public function showRequest(RequestEntity $requestEntity)
    {
        return $requestEntity;
    }
}

<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;

class ProductController extends FOSRestController
{
    /**
     * Add Product
     * @Rest\Post("/product/add")
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
     *     )
     * )
     * @SWG\Response(response=200, description="Product created")
     * @SWG\Tag(name="Product")
     * @Security(name="Bearer")
     */
    public function addProduct(Request $request): View
    {
        $product = new Product();
        $product->setName($request->get('name'));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();

        return View::create($product, Response::HTTP_CREATED);
    }

    /**
     * Show Product
     * @Rest\Get("/product/{id}/show")
     *
     * @SWG\Parameter(name="id", in="path", type="integer", description="Product ID")
     * @SWG\Response(response=200, description="Product displayed")
     * @SWG\Tag(name="Product")
     * @Security(name="Bearer")
     */
    public function showProduct(Product $product)
    {
        return $product;
    }

    /**
     * Products List
     * @Rest\Post("/products")
     *
     * @SWG\Response(response=200, description="Products list displayed")
     * @SWG\Tag(name="Product")
     * @Security(name="Bearer")
     */
    public function productsList()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

        return $products;
    }
}

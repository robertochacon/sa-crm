<?php

namespace App\Http\Controllers\Api\v1\Product;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * @OA\Get (
     *     path="/api/products/{company_id}",
     *     operationId="all_products",
     *     tags={"Products"},
     *     summary="All products",
     *     description="All products",
     *     @OA\Parameter(
     *         in="path",
     *         name="company_id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example=""),
     *              @OA\Property(property="icon", type="string", example=""),
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example=""),
     *          )
     *      )
     * )
     */
    public function index($company_id)
    {
        $products = $this->productRepository->allProductsByCompapyId($company_id);
        return response()->json(["data"=>$products],200);
    }

}

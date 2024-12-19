<?php

namespace App\Http\Controllers\Api\v1\Category;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * @OA\Get (
     *     path="/api/categories/{company_id}",
     *     operationId="all_categories",
     *     tags={"Category"},
     *     summary="All categories",
     *     description="All categories",
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
        $categories = $this->categoryRepository->allCategoriesByCompanyId($company_id);
        return response()->json(["data"=>$categories],200);
    }

}

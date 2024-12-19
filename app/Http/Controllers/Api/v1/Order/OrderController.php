<?php

namespace App\Http\Controllers\Api\v1\Order;

use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    /**
     * @OA\Get (
     *     path="/api/orders/{company_id}",
     *     operationId="all_orders",
     *     tags={"Orders"},
     *     summary="All orders",
     *     description="All orders",
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
     *              @OA\Property(property="products", type="string", example=""),
     *              @OA\Property(property="table", type="string", example=""),
     *              @OA\Property(property="total", type="string", example=""),
     *              @OA\Property(property="extra", type="string", example=""),
     *              @OA\Property(property="user", type="string", example=""),
     *              @OA\Property(property="in_restaurant", type="string", example=""),
     *              @OA\Property(property="note", type="string", example=""),
     *              @OA\Property(property="status", type="string", example=""),
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
        $orders = $this->orderRepository->allOrdersByCompapyId($company_id);
        return response()->json(["data"=>$orders],200);
    }

}

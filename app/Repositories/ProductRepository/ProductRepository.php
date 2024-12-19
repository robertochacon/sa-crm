<?php

namespace App\Repositories\ProductRepository;

use App\Models\Product;
use App\Repositories\BaseRepository\BaseRepository;
use Illuminate\Support\Facades\Hash;

class ProductRepository extends BaseRepository
{

    public function __construct(Product $product){
        parent::__construct($product);
    }

    public function allProductsByCompapyId(int $company_id){
        return $this->model->with('category')->where("company_id", $company_id)->get();
    }

}

<?php

namespace App\Repositories\CategoryRepository;

use App\Models\Category;
use App\Repositories\BaseRepository\BaseRepository;
use Illuminate\Support\Facades\Hash;

class CategoryRepository extends BaseRepository
{

    public function __construct(Category $category){
        parent::__construct($category);
    }

    public function allCategoriesByCompanyId(int $company_id){
        return $this->model->where("company_id", $company_id)->get();
    }

}

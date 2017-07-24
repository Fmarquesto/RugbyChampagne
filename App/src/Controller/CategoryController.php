<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 23/7/2017
 * Time: 11:35
 */

namespace App\Controller;

use App\Models\Category;
use Slim\Http\Request;
use Slim\Http\Response;
use Respect\Validation\Validator as v;

class CategoryController extends Controller
{
    public function getCategories(Request $request, Response $response)
    {
        $categories = Category::all()->toArray();
        return $this->view->render($response,'category/categories.twig',[
            "data"=>json_encode($categories)
        ]);
    }

    public function getCategoryCreate(Request $request, Response $response)
    {
        return $this->view->render($response,'category/category-create.twig');
    }

    public function postCategoryCreate(Request $request, Response $response)
    {
        $validation = $this->validator->validate($request,[
            'categoryName'=>v::notEmpty(),
        ]);
        if($validation->failed()){
            return $response->withRedirect($this->router->pathFor('category.create'));
        }

        $category = Category::create([
            'name'=>$request->getParam('categoryName')
        ]);

        $this->flash->addMessage('info', 'Categoria Creada Correctamente');

        return $response->withRedirect($this->router->pathFor('category.create'));
    }
}
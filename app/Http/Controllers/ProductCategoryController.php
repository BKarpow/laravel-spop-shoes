<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\ImageProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    //admin

    /**
     * Метод сторінки створення категорії
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    function create_category_page(){
        $Category = new ProductCategory();
        $cat_list = $Category->select('id', 'parent_id', 'title')->get();
        return view('admin.pages.category.cu', ['data_list' => $cat_list->toArray()]);
    }

    /**
     * Метод який виконує форма додавання категорії при сабміті
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function create_category_form_action(Request $request){
        $Image = new ImageProduct();
        $Category = new ProductCategory();
        $parent_id = (int) $request->input('parent_id', 0);
        $image_id = $Image->addNewImage(
            $request->input('main_image', ''),
            $request->input('image_a', ''),
            $request->input('image_b', ''),
            $request->input('image_c', ''),
            $request->input('image_d', ''),
            $request->input('image_e', ''),
        );
        $Category->addNewCategory(
            $request->input('title', ''),
            $request->input('description', ''),
            (int)$image_id,
            $parent_id
        );
        return redirect()
            ->route('category.create')
            ->with('status', 'Категорію додано');
    }

    function show_products_from_category($category_id){
        $id = intval($category_id);
        if (!ProductCategory::checkCategoryExists($id)){
            abort(404);
        }
        $Product = new Product();
        $Cat = new ProductCategory();
        $data = $Product->getProductsFromCategory($id, $Cat);
        return view('pages.category.index',
            ['data' => $data, 'children'=>$Cat->last_children_category]);
    }

    //Ajax

    /**
     * Метод відображає JSON set каиегорій
     * @return CategoryResource
     */
    function ajax_get_all_category(){
        $Category = new ProductCategory();
        return  new CategoryResource($Category->select('id', 'title')->get());
    }

    function ajax_get_sorted_category(){
        $Category = new ProductCategory();
        return response()->json(['data'=>$Category->getCategorySortedArray()]);
    }


}

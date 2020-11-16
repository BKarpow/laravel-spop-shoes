<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\ImageProduct;
use App\Models\Price;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Метод який перевіряє чи є користувач адміном,
     * якщо ні то повертає помилку 404
     */
    private function isAdminValidator(){
        if (!auth()->user()->isAdmin()){
            abort(404);
        }
    }

    //Методи адмін панелі

    /**
     * Метод сторінки створення товару
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    function create_product_page()
    {
        $this->isAdminValidator();
        return view('admin.pages.product.cu');
    }

    /**
     * Метод який виконує форма створення товару
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function create_product_form_action(Request $request){
        $Image = new ImageProduct();
        $Product = new Product();
        $Attribute = new ProductAttribute();
        $Price = new Price();
        $price_id = $Price->addNewPrice(
            (float) $request->input('uan', 0.0),
            (float) $request->input('uan_min', 0.0),
        );
        $image_id = $Image->addNewImage(
            $request->input('main_image'),
            $request->input('image_a', ''),
            $request->input('image_b', ''),
            $request->input('image_c', ''),
            $request->input('image_d', ''),
            $request->input('image_e', ''),
        );
        $product_id = $Product->addNewProduct(
            $request->input('title', ''),
            $request->input('description', ''),
            (int)$request->input('category_id', 1),
            (int)$price_id,
            (int)$image_id
        );
        $Attribute->addAttributesFromProductAsJsonDump(
            $request->input('attribute_dump', '[]'),
            (int) $product_id
        );
        return redirect()
            ->route('product.create')
            ->with('status', 'Тавар створено');
    }

    //Ajax

    function ajax_popular_products(){
        $Product = new Product();
        return $Product->getPopularProducts();
    }

    function ajax_get_new_product(Request $request)
    {
        $Product = new Product();
        return new ProductResource($Product->getNewProduct());
    }

    function ajax_get_product($product_alias){
        $product_id = (int) $product_alias;
        $Product = new Product();
        $data = $Product->getProductFromId($product_id);
        return response()->json(['data'=>$data]);
    }

    //View

    /**
     * Метод відображення сторінку товару
     * @param $product_alias
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    function show_product($product_alias){
        $product_id = (int) $product_alias;
        $Product = new Product();
        $Attribute = new ProductAttribute();
        $attr = $Attribute->getAttributesFromProductId($product_id);
        $data = $Product->getProductFromId($product_id);
        if (empty($data)){
            abort(404);
        }
        return view('pages.product.card', ['data' => $data, 'attr_g' => $attr]);
    }
}

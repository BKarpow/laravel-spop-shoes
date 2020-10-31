<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    /**
     * Метод сторінку створення атрибутів товару
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    function create_attribute_page(){
        return view('admin.pages.attribute.cu');
    }

    /**
     * Метод форми створення атрибуту
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function create_attribute_form_action(Request $request)
    {
        $Attribute = new ProductAttribute();
        $id = $Attribute->addNewAttribute(
            $request->input('title', ''),
            $request->input('value', '')
        );
        return redirect()
            ->route('attribute.create')
            ->with('status', 'Додано новий атрибут, його ід '. $id);
    }

    /**
     * Метод сторінки додавання атрибуту до товару
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    function add_attribute_from_product()
    {
        $attributes = ProductAttribute::select('id', 'title', 'value')->get();
        $products = Product::select('id', 'title')->get();
        return view('admin.pages.attribute.add_to_product', [
            'attributes' => $attributes,
            'products' => $products
        ]);
    }

    //Ajax
    function get_list_attributes(){
        $Attribute = new ProductAttribute();
        $list = $Attribute->getAllListAttributes();
        return response()->json(['data'=>$list]);
    }
}

<?php


/**
 * Функція рендер яка малює селектор категорій по масиву який було відформатовано за допомогою sorted_tree_category
 * @param array $correct_sort_array - відформатований масив
 * @param string $name_select - атрибут селескора name
 * @param string $css_class - атрибут селескора class
 * @param string $prefix - префікс для вказання категорій дітей
 * @param bool $echo - Якщо true то функція відображатиме html інакше поверне
 * @return mixed
 */
function render_tree_selector(array $correct_sort_array,
                              string $name_select,
                              string $css_class = '',
                              string $prefix = '|-->',
                              bool $echo = false
)
{
    $render_html = '';
    $render_html .= "<select name=\"{$name_select}\" id=\"{$name_select}\" class=\"{$css_class}\">";
    $render_html .= "<option value=\"0\">Без батька</option>";
    foreach($correct_sort_array as $data):
        if (count($data) > 1){
            foreach($data as $k => $it){
                $pref = ($k === 0) ? '' : $prefix;
                $render_html .= '<option value="'.(int)$it['id'].'">'. $pref . htmlspecialchars($it['title']).'</option>';
            }
        }else{
            $render_html .= '<option value="'.(int)$data[0]['id'].'">'. htmlspecialchars( $data[0]['title']).'</option>';
        }
    endforeach;
    $render_html .= '</select>';
    if ($echo){ echo $render_html; }
    return  $render_html;
}


/**
 * Функція яка сортує масив для коректного відображення дерева категорій
 * @param array $arr - невісориований масив
 * @param string $parent_id - ім'я колонки де вказуєтся id батька

 * @return array - Відсортований масив який підійде функції render_tree_selector
 */
function sorted_tree_category(array $arr, string $parent_id = 'parent_id'):array
{
    $new_arr = [];
    foreach($arr as $item){
        $item = (array)$item;
        if ((int)$item[$parent_id] !== 0) continue;
        $new_arr[(int)$item['id']][] = array_filter($item, function($val){
            if ($val === 'title' || $val === 'id' || $val === 'alias'){
                return true;
            }else{
                return false;
            }
        }, ARRAY_FILTER_USE_KEY );
    }
    foreach($arr as $item2){
        $item2 = (array)$item2;
        if ((int)$item2[$parent_id] === 0) continue;
        if (isset($new_arr[(int)$item2[$parent_id]])){
            $new_arr[(int)$item2[$parent_id]][] = array_filter($item2, function($val){
                if ($val === 'title' || $val === 'id' || $val === 'alias'){
                    return true;
                }else{
                    return false;
                }
            }, ARRAY_FILTER_USE_KEY );
        }
    }
    return $new_arr;
}



/**
 * Функція рендер яка малює селектор категорій батьків (з parent_id = 0)
 * @param array $array -  масив категорій
 * @param string $name_select - атрибут селескора name
 * @param string $css_class - атрибут селескора class
 * @param bool $echo - Якщо true то функція відображатиме html інакше поверне
 * @return mixed
 */
function render_parent_category_selector(array $array,
                              string $name_select,
                              string $css_class = '',
                              bool $echo = false
)
{
    $render_html = '';
    $render_html .= "<select name=\"{$name_select}\" id=\"{$name_select}\" class=\"{$css_class}\">";
    $render_html .= "<option value=\"0\">Без батька</option>";
    foreach($array as $data):
        if ((int)$data['parent_id'] !== 0) continue;
        $render_html .= '<option value="'.(int)$data['id'].'">'.htmlspecialchars($data['title']).'</option>';
    endforeach;
    $render_html .= '</select>';
    if ($echo){ echo $render_html; }
    return  $render_html;
}

/**
 * Формує посилання на товар
 * @param int $product_id
 * @param string $format
 * @param string $prefix
 * @return string|string[]
 */
function product_link(int $product_id,
                      string $format = '{id}-{alias}.htnl',
                      string $prefix = '/product/')
{
    $Product = new \App\Models\Product();
    $product = $Product->getProductFromId($product_id);
    $link = str_replace(['{id}', '{alias}'], [$product['id'], $product['alias']], $format);
    return $prefix . $link;
}


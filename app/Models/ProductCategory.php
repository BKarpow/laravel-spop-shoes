<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TextToolTrait;

class ProductCategory extends Model
{
    use HasFactory, TextToolTrait;

    /**
     * Створює нову категорію для товарів
     * @param string $title
     * @param string $description
     * @param int $image_id
     * @param int $parent_id
     * @return bool
     */
    public function addNewCategory(string $title,
                                   string $description,
                                   int $image_id,
                                    int $parent_id = 0
    ):bool
    {
        $alias = $this->getAliasFromString($title);
        $this->title = $title;
        $this->alias = $alias;
        $this->description = $description;
        $this->image_id = $image_id;
        if ($parent_id){
            $this->parent_id = $parent_id;
        }
        return (bool) $this->save();
    }
}

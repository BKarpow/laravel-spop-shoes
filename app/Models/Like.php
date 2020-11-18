<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Like extends Model
{
    use HasFactory;

    private int $user_id = 0;

    private int $set_product_id = 0;

    private int $like_id = 0;

    private string $rel_table = 'rel_user_like';

    /**
     * Ініціює властивості
     * @param int $user_id
     * @param int $product_id
     */
    function init(int $user_id, int $product_id)
    {
        $this->user_id = $user_id;
        $this->set_product_id = $product_id;
    }


    /**
     * Поаертає сутність лайку, або нуль
     * @return Model|null
     */
    private function getLike()
    {
        $l = $this->where('product_id', $this->set_product_id)->first();
        if ($l){
            $this->like_id = (int) $l->id;
            return $l;
        }
        return null;

    }


    /**
     * Створює like
     * @param bool $dislike
     * @return Model
     */
    private function createLike( bool $dislike = false)
    {
        $this->product_id = $this->set_product_id;
        if ($dislike){
            $this->dislikes = 1;
        }else{
            $this->likes = 1;
        }
        $this->save();
        return $this->getLike();
    }


    /**
     * Створює нову реляцію
     * @param bool $dislike
     */
    private function addRelationUserLike(bool $dislike = false)
    {
        $now = now();
        $insert = [
            'user_id' => $this->user_id,
            'like_id' => $this->like_id,
            'created_at' => $now,
            'updated_at' => $now
        ];
        if ($dislike){
            $insert['like'] = false;
            $insert['dislike'] = true;
        }else{
            $insert['like'] = true;
            $insert['dislike'] = false;
        }
        DB::table($this->rel_table)
            ->insert($insert);
    }

    /**
     * Перевіряє чи користувач ставив лайк
     * @return bool
     */
    private function checkRelation()
    {
        return (bool) DB::table($this->rel_table)
            ->where([
                ['user_id', '=', $this->user_id],
                ['like_id', '=', $this->like_id]
            ])
            ->first();
    }

    /**
     * Ставить або лайк або дизлайк
     * @param bool $dislike
     * @return bool
     */
    public function liker(bool $dislike = false)
    {
        $like = $this->getLike();
        if ($like){
            if (!$this->checkRelation()){
                $like->increment(($dislike) ? 'dislikes' : 'likes');
                $this->addRelationUserLike($dislike);
                return true;
            }else{
                return false;
            }
        }else{
            $like = $this->createLike();
            $like->increment(($dislike) ? 'dislikes' : 'likes');
            $this->addRelationUserLike($dislike);
            return true;
        }
    }


    /**
     * Поаертає кількість лайків та дилайків
     * @return mixed
     */
    public function getInfo()
    {
        return $this->where('product_id', $this->set_product_id)->first();
    }

}

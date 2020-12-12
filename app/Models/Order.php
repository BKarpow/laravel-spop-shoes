<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    const STATUS_NEW = 1;
    const STATUS_PROCESS = 2;
    const STATUS_SUCCESS = 3;

    /**
     * Створює новий запис замовлення та повертає його id
     * @param int $product_id
     * @param string $phone
     * @param string $user_name
     * @param string $user_email
     * @param string $user_comment
     * @return int
     */
    public function addNewOrder(int $product_id,
                                string $phone,
                                string $user_name,
                                string $user_email,
                                string $user_comment
                    )
    {
        $now = now();
        DB::table('orders')
            ->insert([
                'product_id' => $product_id,
                'user_phone' => $phone,
                'user_name' => $user_name,
                'user_email' => $user_email,
                'user_comment' => $user_comment,
                'updated_at' => $now,
                'created_at' => $now
            ]);
        send_order_telegram($phone, $product_id);
        return (int) DB::table('orders')
            ->select('id')
            ->where([
                ['product_id', '=', $product_id],
                ['created_at', '=', $now]
            ])->first()->id;
    }

    /**
     * Повертає нові замовлення
     * @return \Illuminate\Support\Collection
     */
    public function getAllNewOrder(){
        return DB::table('orders')
            ->rightJoin('products','orders.product_id', '=', 'products.id')
            ->select('title',
                'alias',
                'user_phone',
                DB::raw('orders.id as id, orders.created_at as created_at'))
            ->where('orders.new', '=', '1')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Повертає запис замовлення
     * @param int $order_id
     * @return mixed
     */
    public function getOrder(int $order_id)
    {
        $order = $this->where('orders.id', '=', $order_id)
            ->leftJoin('products', 'products.id', '=', 'orders.product_id')
            ->select(DB::raw('orders.*, title'))
            ->first();
        $order->new = false;
        $order->save();
        return $order;
    }

    /**
     * Статичний метод який інтерпритує код статусу замовлення
     * @param int $status_code
     * @return string
     */
    public static function getStatusString(int $status_code):string
    {
        switch ($status_code){
            case self::STATUS_NEW:
                return 'New order';
                break;
            case self::STATUS_PROCESS:
                return 'Order in process';
                break;
            case self::STATUS_SUCCESS:
                return 'Order success!';
                break;
            default:
                return 'Error status order code';
        }
    }


    /**
     * Змінює статус замовлення
     * @param int $order_id - ід замовлення
     * @param string $status - new|process|success
     * @return false
     */
    public function setStatus(int $order_id, string $status)
    {
        $status = strtolower(trim($status));
        if ($status === 'new'){
            $status_code = self::STATUS_NEW;
        }elseif($status === 'process'){
            $status_code = self::STATUS_PROCESS;
        }elseif($status === 'success'){
            $status_code = self::STATUS_SUCCESS;
        }else{
            $status_code = self::STATUS_NEW;
        }
        $ord = $this->where('id', $order_id)->first();
        if ($ord){
            $ord->status = $status_code;
            return $ord->save();
        }else{
            return false;
        }
    }
}

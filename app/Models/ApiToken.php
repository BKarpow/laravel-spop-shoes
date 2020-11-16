<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ApiToken extends Model
{
    use HasFactory;

    /**
     * Максимальна кількість токенів для користувача
     * @var int
     */
    private int $max_token_count = 10;

    /**
     * Приватний метод який перевіряю кількість токенів
     * @param int $user_id
     * @return bool
     */
    private function testTokenCount(int $user_id):bool
    {
        $res = DB::table('api_tokens')
            ->where('user_id', $user_id)
            ->get();
        return ($res->count() >= $this->max_token_count) ? false : true;
    }


    /**
     * Повертає колекцію токенів для користувача
     * @param int $user_id
     * @return \Illuminate\Support\Collection
     */
    public function getAllTokensFromUser(int $user_id)
    {
        return DB::table('api_tokens')
            ->where('user_id', $user_id)
            ->orderBy('id', 'desc')
            ->get();
    }



    /**
     * Медод створює випадковий токен для користувача та поаертає його,
     * або false якщо кількість токенів більша або рівна максимальні
     * @param int $user_id
     * @return string|false
     */
    public function createNewToken(int $user_id){
        if (!$this->testTokenCount($user_id)){
            return false;
        }
        $token = Str::random(32);
        $ref = $this->where('token', $token)->first();
        if (!$ref){
            $this->user_id = $user_id;
            $this->token = $token;
            $this->save();
            return $token;
        }else{
            return $this->createNewToken($user_id);
        }
    }


    /**
     * Метод перемикач активності токену (вмикає/вимикає) токен
     * @param string $token
     * @return bool - true якщо процедура була успішна
     */
    public function tokenToggle(string $token)
    {
        $tk = $this->where('token', $token)->first();
        if ($tk){
            $tk->active = !(bool)$tk->active;
            $tk->save();
            return true;
        }
        return false;
    }


    /**
     * Метод який верефікує (перевіряє) токен
     * @param string $token
     * @return bool
     */
    public function tokenVerify(string $token){
        $tk = $this->where('token', $token)->first();
        if ($tk){
            if ((bool)$tk->active){
                $tk->increment('working');
                return true;
            }
        }
        return false;

    }

    /**
     * Метод видаляє токен
     * @param string $token
     * @return mixed
     */
    public function deleteToken(string $token){
        return $this->where('token', $token)->delete();
    }
}

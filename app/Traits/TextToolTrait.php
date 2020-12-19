<?php

namespace App\Traits;

/*
 * Gits (GitHub): https://gist.github.com/KostyaTretyak/b2544479ef29f729237d
 * */

trait TextToolTrait{

    /**
     * Фільтрує рядок, обмежує рядок до 40 символів!
     * @param string $value
     * @return string
     */
    private function scoped_string(string $value):string
    {
        $value = strip_tags($value);
        $value = preg_replace('#[^\sa-z0-9А-Яa-яіІїЇєЄ]#si', '', $value);
        $value = htmlspecialchars($value);
        $value = trim($value);
        $value = substr($value, 0, 40);
        return $value;
    }

    /**
     * Роботь транслітерацію рядка, яка підхожить для аліасів
     * @param string $str
     * @return string
     */
    public function getAliasFromString(string $str):string {
        $str = trim($str);
        // Видаляємо зайві символи

        $str = preg_replace('#\s+#si', ' ', $str);
        $str = preg_replace('#\s#si', '_', $str);

        return $this->uk_to_lat($str);
    }

    public function uk_to_lat(string $str):string
    {
        $uk_to_lat_arr = $this->uk_to_lat_arr();
        $str = strtr( $str, $uk_to_lat_arr );
        $str = preg_replace('#[^a-z0-9\_]#si', '', $str);
        $str = strtolower( trim($str) );
        return str_replace(['Ь','ь', "'"], '', $str);
    }

    function lat_to_uk($str)
    {
        $uk_to_lat_arr = $this->uk_to_lat_arr();
        $from = array_values($uk_to_lat_arr);
        $to = array_keys($uk_to_lat_arr);
        return strtr( $str, array_combine($from, $to) );
    }



    function uk_to_lat_arr()
    {
        return [
            'А' => 'A',
            'а' => 'a',
            'Б' => 'B',
            'б' => 'b',
            'В' => 'V',
            'в' => 'v',
            'Г' => 'H',
            'г' => 'h',
            'Ґ' => 'G',
            'ґ' => 'g',
            'Д' => 'D',
            'д' => 'd',
            'Е' => 'E',
            'е' => 'e',
            'Є' => 'Ye',
            'є' => 'ie',
            'Ж' => 'Zh',
            'ж' => 'zh',
            'З' => 'Z',
            'з' => 'z',
            'И' => 'Y',
            'и' => 'y',
            'І' => 'I',
            'і' => 'i',
            'Ї' => 'Yi',
            'ї' => 'i',
            'Й' => 'Y',
            'й' => 'i',
            'К' => 'K',
            'к' => 'k',
            'Л' => 'L',
            'л' => 'l',
            'М' => 'M',
            'м' => 'm',
            'Н' => 'N',
            'н' => 'n',
            'О' => 'O',
            'о' => 'o',
            'П' => 'P',
            'п' => 'p',
            'Р' => 'R',
            'р' => 'r',
            'С' => 'S',
            'с' => 's',
            'Т' => 'T',
            'т' => 't',
            'У' => 'U',
            'у' => 'u',
            'Ф' => 'F',
            'ф' => 'f',
            'Х' => 'Kh',
            'х' => 'kh',
            'Ц' => 'Ts',
            'ц' => 'ts',
            'Ч' => 'Ch',
            'ч' => 'ch',
            'Ш' => 'Sh',
            'ш' => 'sh',
            'Щ' => 'Shch',
            'щ' => 'shch',
            'Ю' => 'Yu',
            'ю' => 'iu',
            'Я' => 'Ya',
            'я' => 'ia'
        ];
    }
}

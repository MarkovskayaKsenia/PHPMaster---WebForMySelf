<?php


namespace app\models;


use ishop\base\Model;

class AppModel extends Model
{
    public static function createAlias($table, $field, $str, $id)
    {
        $str = self::str2url($str);
        $result = \R::findOne($table, "$field = ? ", [$str]);
        if ($result) {
            $str = "{$str}-{$id}";
            $result = \R::count($table, "$field = ? ", [$str]);
            if ($result) {
                $str = self::createAlias($table, $field, $str, $id);
            }
        }
        return $str;
    }

    public static function str2url($str) {
        // в нижний регистр
        $str = mb_strtolower($str);
        // переводим в транслит
        $str = self::rus2translit($str);
        // заменям все ненужное нам на "-"
        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
        // удаляем начальные и конечные '-'
        $str = trim($str, "-");
        return $str;
    }

    public static function rus2translit($string) {

        $converter = array(

            'а' => 'a',   'б' => 'b',   'в' => 'v',

            'г' => 'g',   'д' => 'd',   'е' => 'e',

            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',

            'и' => 'i',   'й' => 'y',   'к' => 'k',

            'л' => 'l',   'м' => 'm',   'н' => 'n',

            'о' => 'o',   'п' => 'p',   'р' => 'r',

            'с' => 's',   'т' => 't',   'у' => 'u',

            'ф' => 'f',   'х' => 'h',   'ц' => 'c',

            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',

            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',

            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        );

        return strtr($string, $converter);

    }

}
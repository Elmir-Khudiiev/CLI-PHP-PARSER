<?php

class Image
{

// Поиск картинок
    public function ListImage($site, $url) {
        preg_match_all('#<img.+?src="(.+?).jpg".+?>#', $site, $result); // Поиск (.jpg).
        preg_match_all('#<img.+?src="(.+?).png".+?>#', $site, $result1); // Поиск (.png).
        preg_match_all('#<img.+?src="(.+?).gif".+?>#', $site, $result2); // Поиск (.gif).


    //Валидация сылок на картинки

        // Правка форматов для изображений и добавление всех ссылок в один масив $pictures.
            foreach ($result[1] as $item) {
                $pictures[] = DOMAIN .'/'. $item. '.jpg';
            }
            foreach ($result1[1] as $item) {
                $pictures[] = DOMAIN .'/'. $item. '.png';
            }
            foreach ($result2[1] as $item) {
                $pictures[] = DOMAIN .'/'. $item. '.gif';
            }

        // Удаление лишних символов
            foreach($pictures as $pict) {
                $a[] = str_replace('/../../', '/', $pict);
            }
            foreach($a as $pict) {
                $b[] = str_replace('/../', '/', $pict);
            }
            foreach($b as $pict) {
                $f_pictures_link[] = str_replace('//', '/', $pict);
            }

        // Удаляем дубли из масива изображений.
            $f_pictures_link = array_unique($f_pictures_link);

            array_unshift(
                $f_pictures_link,
                "Source link: ".$url."\n",
                '');

        return $f_pictures_link;

    }

}


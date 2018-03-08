<?php


class Comand
{

    public function Parse($url) {
            $content = new AllContent($url);
            $SiteContent = $content->SiteContent(); // Все содержимое на указаной странице.

            $link = new Links;
            $ListLinks = $link->ListLinks($SiteContent, $url); // Список ссылок на указаном адрессе.

            $image = new Image;
            $ListImage = $image->ListImage($SiteContent, $url); // Список картинок на указаном адрессе.

            $report = new Report;
            $report->ReportCSV($ListLinks, ''.ROOT.'/report_files/'.DOMAIN.'_List_Links.csv'); // Сохраняем список ссылок.
            $report->ReportCSV($ListImage, ''.ROOT.'/report_files/'.DOMAIN.'_List_Image.csv'); // Сохраняем список изображений.

            echo "\n\nНайдено ссылок: ".(count($ListLinks)-2);
            echo "\nНайдено изображений: ".(count($ListImage)-2);
            echo "\n\nСписок найденых ссылок: ".ROOT.'\report_files\\'.DOMAIN.'_List_Links.csv';
            echo "\nСписок найденых изображений: ".ROOT.'\report_files\\'.DOMAIN.'_List_Image.csv';

    }

    public function Help() {
            echo "\nparse - запускает парсер, принимает обязательный параметр url (как с протоколом, так и без).";
            echo "\nreport - выводит в консоль результаты анализа для домена.";
            echo "\nhelp - выводит список команд с пояснениями.\n\n";

    }

    public function ReportList() {
        $ReportList = new Report;
        $domain = readline('Введите домен страницы, для поиска соответствия, найденых даных: ');
        $ReportList->ViewsReportCSV($domain);
    }
}
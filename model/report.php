<?php

class Report
{
    // Запись найденых даных в файл CSV.
    public function ReportCSV($date, $adres) {
        $fp = fopen($adres, 'a');
        foreach($date as $string) {
            $dates[] = $string."\n";
        }
        fputcsv($fp, $dates);
        fclose($fp);
    }

    public function ViewsReportCSV($domain) {
    // Просмотр файлов отчета.

        // Валидация домена.
            $corect_domain = preg_match('#http#', $domain);

            if($corect_domain !== 0) {
                $segments = explode('/', $domain);
                $domain = $segments[2];
            } else {
                $segments = explode('/', $domain);
                $domain = $segments[0];
            }


        // Поиск файла отчета ссылок.
            $fl_link = ''.ROOT.'/report_files/'.$domain.'_List_Links.csv';
            if(file_exists($fl_link)) {
                $f_link = fopen('./report_files/'.$domain.'_List_Links.csv', 'r');
                $arr_link = fgetcsv($f_link);
                fclose($f_link);

                echo "\n\nНайдено ссылок: ".count($arr_link);
                echo "\nОтчет со списком ссылок, по указанном домене: ".ROOT.'\report_files\\'.$domain.'_List_Links.csv';
            } else {
                echo "\n\nНе найдено, файлов отчета, со списком ссылок, по указанном домене!";
            }

            


        // Поиск файла отчета изображений.
            $fl_img = ''.ROOT.'/report_files/'.$domain.'_List_Image.csv';
            if(file_exists($fl_img)) {
                $f_image = fopen('./report_files/'.$domain.'_List_Image.csv', 'r');
                $arr_img = fgetcsv($f_image);
                fclose($f_image);

                echo "\n\nНайдено изображений: ".count($arr_img);
                echo "\nОтчет со списком изображений, по указанном домене: ".ROOT.'\report_files\\'.$domain.'_List_Image.csv';
                exit();
            } else {
                echo "\nНе найдено, файлов отчета, со списком изображений, по указанном домене!";
                exit();
            }

    }

    public function OpenReportCSV() {
        $fl_link = fopen(''.ROOT.'/report_files/'.DOMAIN.'_List_Links.csv', 'r');
        $arr_link = fgetcsv($fl_link);
        $arr_link = array_unique($arr_link);
        fclose($fl_link);


        return $arr_link;
    }
}
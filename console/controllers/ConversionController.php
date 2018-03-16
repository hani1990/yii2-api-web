<?php
/**
 * Created by PhpStorm.
 * User: liuhan
 * Date: 2018/1/31
 * Time: 下午3:40
 */

namespace console\controllers;


use yii\console\Controller;

class ConversionController extends Controller
{
    public function actionHtml2Word()
    {
        $name = time();
        $html = "./{$name}.html";

        $url = "http://59.172.107.26:8086/index.php?r=paper/index&pid=16";
        $html_content = file_get_contents($url);
        file_put_contents($html, $html_content);

        $doc_name = "./backend/web/word/{$name}.docx";
        $cmd = "pandoc -f html -s " . $html . "  -o ". $doc_name ;
        exec($cmd, $output);
        var_dump($output);
    }

}
<?php


namespace app\models;


class Upload
{
    private string $uploadFolder = "etlapok/";

    public function uploadFile($files, $post)
    {
        $week = substr($post['week'], -2);
        echo $week;
        $target = $this->uploadFolder.$week."_Het_HU.xls";
//        Ez nem biztos, hogy fog kelleni:
        if (file_exists($target)) {
            echo '<script type="text/javascript">alert("Az adott hétre már van étlap, kérlek válassz másikat")</script>';
        } else {
            move_uploaded_file($files["etlap"]["tmp_name"], $target);
        }
    }
}
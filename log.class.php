<?php
/*
  Author: Mustafa Salman YT
  Web: mustafa.slmn.tr
  Mail: mustafa@slmn.tr
*/

!defined("index") ? die("Geçersiz İstek :(") : null;
date_default_timezone_set('Europe/Istanbul');

class log
{
    private $path = '/logs/';
    private $mode = '';
    public function __construct($mode = '')
    {
        date_default_timezone_set('Europe/Istanbul');
        $this->path = dirname(__FILE__) . $this->path;
        $this->mode = $mode;
    }

    public function write($message)
    {
        $date = new DateTime();
        $log = $this->path . $date->format('Y-m-d') . ".log";

        $logcontent = "Time : " . $date->format('Y-m-d H:i:s') . "\r\nHata : " . $message . "\r\n";
        $adminContent = '';
        
        if ($this->mode == 'admin') {
            $adminContent .= "<span style='color:red'>Hata dosyasına kaydedildi! \r\n</span>" . $logcontent;
            
            echo $adminContent;
        }

        if (is_dir($this->path)) {
            if (!file_exists($log)) {
                $fh = fopen($log, 'a+') or die("Fatal Error !");
                fwrite($fh, $logcontent);
                fclose($fh);
            } else {
                $this->edit($log, $date, $message);
                if ($this->mode != 'admin') {
                    echo '<span class="fs-7 position-absolute opacity-40">Bir hata oluştu. Bu sorun devam ediyor ise lütfen ekibimize bildirin!</span>';
                }
            }
        } else {
            if (mkdir($this->path, 0777) === true) {
                $this->write($message);
                if ($this->mode != 'admin') {
                    echo '<span class="fs-7 position-absolute opacity-40">Bir hata oluştu. Bu sorun devam ediyor ise lütfen ekibimize bildirin!</span>';
                }
            }
        }
    }

    private function edit($log, $date, $message)
    {
        $logcontent = "Time : " . $date->format('Y-m-d H:i:s') . "\r\n" . $message . "\r\n\r\n";
        $logcontent = $logcontent . file_get_contents($log);
        file_put_contents($log, $logcontent);
    }
}

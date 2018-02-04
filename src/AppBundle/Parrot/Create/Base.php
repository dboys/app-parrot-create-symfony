<?php

namespace AppBundle\Parrot\Create;

class Base {
    public $name;
    public $template_content;
    private $logger = null;

    function __construct($params = array()) {
        if (is_array($params)) {
            $required_params_list = array("name",'template_content');
            $option_params_list = array("logger");

            foreach ($required_params_list as $val) {
                if (!empty($params) && !empty($params[$val])) {
                    $this->$val = $params[$val];
                }
                else {
                    throw new \Exception("{$val} is required");
                }
            }

            foreach ($option_params_list as $val) {
                if (!empty($params) && !empty($params[$val])) {
                    $this->$val = $params[$val];
                }
            }
        }
        else {
            throw new \Exception("Input parameters should be an array");
        }
    }

    function generate_project() {
        $res = array();
        $time = time();
        $file_path = "/tmp/$time/app-parrot-create-XXXXXXX";
        $lines_list = explode(PHP_EOL, $this->template_content);
        $fh = null;

        foreach ($lines_list as $line) {
            if (preg_match('/__END__/', $line)) {
                break;
            }

            if (preg_match('/__(?<file>.*)__/', $line, $matches)) {
                $file = $matches['file'];
                $full_file_path = "{$file_path}/{$file}";
                $path_info = pathinfo($full_file_path);

                if (!file_exists($path_info['dirname'])) {
                    mkdir($path_info['dirname'], 0777, true);
                }

                if ($fh) {
                    fclose($fh);
                    $fh = null;
                }

                $fh = fopen($full_file_path,'w') or die("Unable to open {$full_file_path} file!");;
            }
            else {
                if ($fh){
                    if ($line) {
                        fwrite($fh, $line);
                    }
                    else {
                        fwrite($fh, PHP_EOL);
                    }
                }
            }

        }

        return $file_path;
    }

    function generate_archive($dir_path) {
        $time = time();
        $zip_path = "/tmp/{$time}-{$this->name}.zip";
        $path_info = pathinfo($dir_path);
        $zip = new \ZipArchive;
        $zip->open($zip_path, \ZipArchive::CREATE);

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($dir_path),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            if (! $file->isDir()) {
                $file_path = $file->getRealPath();

                $relative_path = substr($file_path, strlen($dir_path));

                $zip->addFile($file_path, "{$path_info['basename']}/{$relative_path}");
            }
        }

        $zip->close();

        return $zip_path;
    }

    function generate() {
        $project_filepath = $this->generate_project();

        if (file_exists($project_filepath)){
            $zip_path = $this->generate_archive($project_filepath);
            return $zip_path;
        }

        return null;
    }
}
<?php

namespace App\Library;

class ImageUpload
{
    // Image Full Name
    protected $name = '';

    // Image Temporary Name
    protected $tmp_name = '';

    // Image Size
    protected $size = 0;

    // Accepted Extentions
    protected $accepted_extention = [];

    // Get Original Name
    private function originalName()
    {
        $divide    = explode('.', $this->name);
        $origrinal_name = $divide[0];
        return $origrinal_name;
    }

    // Get Image Extention
    private function extention()
    {
        $divide    = explode('.', $this->name);
        $extention = end($divide);
        return $extention;
    }

    // Generate Unique Name
    private function uniqueName($str_limit = 8)
    {
        $unique     = substr(md5(time()), 0, $str_limit);
        $uniqueName = $this->originalName().'_'.$unique.'.'.$this->extention();
        return $uniqueName;
    }

    // Set Image File
    public function image($file, $file_name)
    {
        $this->name     = $file[$file_name]['name'];
        $this->tmp_name = $file[$file_name]['tmp_name'];
        $this->size     = $file[$file_name]['size'];
        return $this;
    }

    // Set Allowed Extentions
    public function allowedExtention($extentions = [])
    {
        $this->accepted_extention = $extentions;
        return $this;
    }

    // Final Upload
    public function upload($destination)
    {
        if (count($this->accepted_extention) > 0) {
            if (!in_array($this->extention(), $this->accepted_extention)) {
                return false;
            }
        } 
        
        if ($this->size > (2 * 1024 * 1024)) {
            return false;
        } else {
            $upload = move_uploaded_file($this->tmp_name, $destination.'/'.$this->uniqueName());
            if ($upload) {
                return $destination.'/'.$this->uniqueName(); 
            }
        }
    }


}
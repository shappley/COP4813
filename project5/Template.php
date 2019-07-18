<?php

class Template
{
    protected $path, $data;

    public function __construct($path, $content, $data = array())
    {
        $data["content"] = $content;
        $this->path = $path;
        $this->data = $data;
    }

    public function render()
    {
        if (file_exists($this->path)) {
            extract($this->data);

            ob_start();

            require_once($this->path);
            $buffer = ob_get_contents();
            @ob_end_clean();

            return $buffer;
        }
        return "";
    }
}
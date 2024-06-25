<?php


class Request{

    private array $get =[];
    private array $post = [];

    public function __construct($get,$post)
    {
        $this->get=$get;
        $this->post=$post;
    }

    public function getParam(string $name,$default = null)
    {
        return $this->get[$name] ?? null;
    }

    public function postParam(string $name,$default = null)
    {
        return $this->post[$name] ?? null;
    }

}
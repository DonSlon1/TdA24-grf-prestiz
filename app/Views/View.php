<?php

namespace App\Views;

class View
{
    protected string $viewFile;

    public static function createWithViewFile(string $viewFile): self
    {
        $self = new self();
        $self->viewFile = $viewFile;
        return $self;
    }

    public function setViewFile(string $viewFile): void
    {
        $this->viewFile = $viewFile;
    }

    public function render($data = []): void
    {
        extract((array)$data);
        include($this->viewFile);
    }
}

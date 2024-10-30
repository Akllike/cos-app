<?php

namespace App\Http\Interfaces;

interface CatalogInterface
{
    public function addMuses(): array;
    public function addScrabs(): array;
    public function addGels(): array;
}

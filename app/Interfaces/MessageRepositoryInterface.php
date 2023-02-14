<?php

namespace App\Interfaces;

interface   MessageRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function create($data);
}

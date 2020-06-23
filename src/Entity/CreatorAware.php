<?php

namespace App\Entity;

interface CreatorAware
{
    public function getCreator(): ?User;
    public function setCreator(User $user);
}
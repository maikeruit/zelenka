<?php

namespace app\common\parser;

interface ParserInterface
{
    public function execute(array $data): void;
}
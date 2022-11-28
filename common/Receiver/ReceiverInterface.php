<?php

namespace app\common\receiver;

interface ReceiverInterface
{
    public function receiveFromUrl(string $url): array;

    public function receiverFromPath(string $path): array;

    public function getContent(string $path, bool $associative = true): array;
}
<?php

namespace app\common\receiver;

interface ReceiverInterface
{
    public function __construct(string $path);

    public function receiveFromUrl(): array;

    public function receiverFromPath(): array;

    public function getContent(string $path, bool $associative = true): array;
}
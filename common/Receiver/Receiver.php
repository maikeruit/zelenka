<?php

namespace app\common\receiver;

use app\common\exceptions\ReceiverException;
use Yii;

class Receiver implements ReceiverInterface
{
    public function __construct(private string $path)
    {
    }

    /**
     * @return array
     * @throws ReceiverException
     */
    public function receiveFromUrl(): array
    {
        if (!filter_var($this->path, FILTER_VALIDATE_URL)) {
            throw new ReceiverException('Type "url" must be a link to a json file.');
        }

        return $this->getContent($this->path);
    }

    /**
     * @return array
     * @throws ReceiverException
     */
    public function receiverFromPath(): array
    {
        $path = Yii::getAlias('@uploads') . DIRECTORY_SEPARATOR . $this->path;

        if (!file_exists($path)) {
            throw new ReceiverException('Type "path" must be a path to a json file.');
        }

        return $this->getContent($path);
    }

    /**
     * @param string $path
     * @param bool $associative
     * @return array
     * @throws ReceiverException
     */
    public function getContent(string $path, bool $associative = true): array
    {
        $json = file_get_contents($path);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ReceiverException('Json parse error');
        }

        return json_decode($json, $associative);
    }
}
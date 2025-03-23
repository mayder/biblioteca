<?php

namespace app\traits;

use app\components\Utils;

trait UuidTrait
{
    public function generateUuidIfEmpty()
    {
        if ($this->isNewRecord && empty($this->uuid)) {
            $this->uuid = Utils::generateUuid();
        }
    }
}

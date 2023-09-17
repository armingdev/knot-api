<?php

namespace App\Enums;

enum TaskStatusEnum: string
{
    case Finished = 'finished';
    case Failed = 'failed';
}

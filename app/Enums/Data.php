<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Gender extends Enum
{
    const MALE = '男';
    const FEMALE = '女';
}

final class Role extends Enum
{
    const VISITOR = '訪客';
    const TRAINEE = '學員';
    const FREELANCER = '進駐者';
    const MANAGER = '管理者';
    const OTHER = '其他';
}

<?php
declare(strict_types=1);

namespace App\Models;

use ManaPHP\Model\Attribute\PrimaryKey;
#[PrimaryKey('login_id')]
class UserLoginLog extends Model
{
    public int $login_id;
    public int $user_id;
    public string $user_name;
    public string $client_ip;
    public string $client_udid;
    public string $user_agent;
    public int $created_time;
}
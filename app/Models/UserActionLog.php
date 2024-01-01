<?php
declare(strict_types=1);

namespace App\Models;

class UserActionLog extends Model
{
    public int $id;
    public int $user_id;
    public string $user_name;
    public string $method;
    public string $handler;
    public int $tag;
    public string $url;
    public string $data;
    public string $client_ip;
    public string $client_udid;
    public int $created_time;
}

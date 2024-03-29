<?php
declare(strict_types=1);

namespace App\Areas\User\Controllers;

use ManaPHP\Http\Controller\Attribute\Authorize;
use ManaPHP\Mvc\Controller;

#[Authorize('user')]
class MenuController extends Controller
{
    public function indexAction()
    {
        $menu = [
            ['group_name' => '个人中心',
             'items'      => [
                 ['item_name' => '最近登录', 'url' => '/user/login_log/latest'],
                 ['item_name' => '最近操作', 'url' => '/user/action_log/latest'],
                 ['item_name' => '修改密码', 'url' => '/user/password/change'],
             ]],
        ];

        foreach ($menu as &$group) {
            $group['icon'] ??= 'el-icon-caret-right';
            foreach ($group['items'] as &$item) {
                $item['icon'] ??= 'el-icon-arrow-right';
            }
        }

        return $menu;
    }
}
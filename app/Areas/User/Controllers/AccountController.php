<?php
declare(strict_types=1);

namespace App\Areas\User\Controllers;

use App\Controllers\Controller;
use App\Models\User;
use ManaPHP\Di\Attribute\Autowired;
use ManaPHP\Http\CaptchaInterface;
use ManaPHP\Http\Controller\Attribute\Authorize;
use ManaPHP\Http\ResponseInterface;

#[Authorize('*')]
class AccountController extends Controller
{
    #[Autowired] protected CaptchaInterface $captcha;

    public function captchaAction(): ResponseInterface
    {
        return $this->captcha->generate();
    }

    public function registerAction(string $code, string $password)
    {
        $this->captcha->verify($code);

        return User::fillCreate(
            $this->request->all(),
            ['white_ip' => '*', 'status' => User::STATUS_ACTIVE, 'password' => $password]
        );
    }
}
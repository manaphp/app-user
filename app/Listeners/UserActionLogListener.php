<?php
declare(strict_types=1);

namespace App\Listeners;

use App\Models\UserActionLog;
use ManaPHP\Context\ContextTrait;
use ManaPHP\Db\Event\DbExecuting;
use ManaPHP\Di\Attribute\Autowired;
use ManaPHP\Eventing\Attribute\Event;
use ManaPHP\Helper\Arr;
use ManaPHP\Http\CookiesInterface;
use ManaPHP\Http\DispatcherInterface;
use ManaPHP\Http\RequestInterface;
use ManaPHP\Identifying\IdentityInterface;

class UserActionLogListener
{
    use ContextTrait;

    #[Autowired] protected IdentityInterface $identity;
    #[Autowired] protected RequestInterface $request;
    #[Autowired] protected CookiesInterface $cookies;
    #[Autowired] protected DispatcherInterface $dispatcher;

    protected function getTag(): int
    {
        foreach ($this->request->all() as $k => $v) {
            if (is_numeric($v)) {
                if ($k === 'id') {
                    return (int)$v;
                } elseif (str_ends_with($k, '_id')) {
                    return (int)$v;
                }
            }
        }

        return 0;
    }

    public function onUserActionLogAction(#[Event] DbExecuting|UserActionLog $event): void
    {
        /** @var UserActionLogListenerContext $context */
        $context = $this->getContext();
        if ($context->logged) {
            return;
        }

        if ($event instanceof DbExecuting) {
            if (!$this->dispatcher->isInvoking() || $this->dispatcher->getArea() !== 'User') {
                return;
            }
        }

        $context->logged = true;

        $data = Arr::except($this->request->all(), ['_url']);
        if (isset($data['password'])) {
            $data['password'] = '*';
        }
        unset($data['ajax']);

        $userActionLog = new UserActionLog();
        $userActionLog->user_id = $this->identity->isGuest() ? 0 : $this->identity->getId();
        $userActionLog->user_name = $this->identity->isGuest() ? '' : $this->identity->getName();
        $userActionLog->client_ip = $this->request->ip();
        $userActionLog->method = $this->request->method();
        $userActionLog->url = $this->request->path();
        $userActionLog->tag = $this->getTag() & 0xFFFFFFFF;
        $userActionLog->data = json_stringify($data);
        $userActionLog->handler = $this->dispatcher->getHandler();
        $userActionLog->client_udid = $this->cookies->get('CLIENT_UDID');
        $userActionLog->create();
    }
}
<?php
namespace App\Controllers;

use ManaPHP\Mvc\Controller;
use ManaPHP\Version;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->response->redirect('about');
    }

    public function aboutAction()
    {
        $this->view->setVar('version', Version::get());
        $this->view->setVar('current_time', date('Y-m-d H:i:s'));
    }
}

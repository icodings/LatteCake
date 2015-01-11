<?php

namespace Demo\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class DefaultController
 * @Route("/")
 * @package Demo\WebBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * 默认首页
     * @Route("/index/{name}")
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($name)
    {
        return $this->render('DemoWebBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     * 获取导航栏模板
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function navigationAction()
    {
        return $this->render('DemoWebBundle:Public:navigation.html.twig');
    }
}

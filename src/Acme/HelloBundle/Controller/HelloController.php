<?php
/**
 * Created by PhpStorm.
 * User: cong
 * Date: 14-11-20
 * Time: 下午5:11
 */

namespace Acme\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class HelloController
 * @Route("/hello")
 * @package Acme\HelloBundle\Controller
 */
class HelloController extends Controller
{
    /**
     * @Route("/")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $name = 'CongWang';
        return $this->render('AcmeHelloBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     * @Route("/test")
     */
    public function testAction()
    {
        print "Hello TestAction";
    }

    /**
     * @Route("/ha")
     */
    public function haAction()
    {
        print "Hello HaAction";die;
    }

}
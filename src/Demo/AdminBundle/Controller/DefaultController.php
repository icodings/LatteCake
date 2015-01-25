<?php

namespace Demo\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class DefaultController
 * @Route("/admin")
 * @package Demo\AdminBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * 后台前首页
     * @Route("/index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('DemoAdminBundle:Default:index.html.twig');
    }

    /**
     * 获取菜单
     * @Route("/navigation")
     * @return JsonResponse
     */
    public function navigationAction()
    {
        $response = [
            [
                'text' => '慢生活',
                'id'   => 'Life',
                'expanded' => true,
                'description' => '菜单列表',
                'children' => [
                    [
                        'id' => 'LifeList',
                        'text' => '文章列表',
                        'leaf' => true,
                        'link' => ''
                    ]
                ]
            ],
            [
                'text' => '碎言碎语',
                'id'   => 'Mood',
                'expanded' => true,
                'description' => '菜单列表',
                'children' => [
                    [
                        'id' => 'MoodList',
                        'text' => '碎语列表',
                        'leaf' => true,
                        'link' => ''
                    ]
                ]
            ]
        ];

        return new JsonResponse($response);
    }
}

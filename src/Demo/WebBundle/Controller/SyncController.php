<?php
/**
 * Created by PhpStorm.
 * User: cong
 * Date: 15-1-12
 * Time: 上午11:54
 */

namespace Demo\WebBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class SyncController
 * @Route("/sync")
 * @package Demo\WebBundle\Controller
 */
class SyncController extends Controller
{
    /**
     * 同步评论数据
     * @Route("/comments")
     * @param Request $request
     * @return JsonResponse
     */
    public function commentsAction( Request $request )
    {
        $logger = $this->get('logger');
        // http://api.duoshuo.com/log/list.json?short_name=api&secret=c9d92470f13da30f2da8f48a4f4e167a
        $action     = $request->get('action');
        $signature  = $request->get('signature');

        $url = "http://api.duoshuo.com/log/list.json?short_name=api&secret=c9d92470f13da30f2da8f48a4f4e167a";


        $response = array
        (
            'action'    => $action,
            'signature' => $signature
        );



        $client = '';

        $crawler = $client->request('GET', $url);

        $logger->info(__CLASS__.'|'.__FUNCTION__."|action={$action}|signature={$signature}");
        return new JsonResponse($response);
    }
} 
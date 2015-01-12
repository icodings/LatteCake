<?php
/**
 * Created by PhpStorm.
 * User: cong
 * Date: 15-1-12
 * Time: 上午11:54
 */

namespace Demo\WebBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     */
    public function commentsAction( Request $request )
    {
        // http://api.duoshuo.com/log/list.json
        $action     = $request->get('action');
        $signature  = $request->get('signature');

        echo 'action:'.$action.'<br />';
        echo 'signature:'.$signature.'<br />';die;
    }
} 
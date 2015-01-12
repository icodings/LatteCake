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
use GuzzleHttp\Client;
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

        $url = "http://api.duoshuo.com/log/list.json";


        // Create a client to work with the Twitter API
        $client = new Client('https://api.twitter.com/{version}', array(
            'version' => '1.1'
        ));

// Sign all requests with the OauthPlugin
//        $client->addSubscriber(new Guzzle\Plugin\Oauth\OauthPlugin(array(
//            'consumer_key'  => '***',
//            'consumer_secret' => '***',
//            'token'       => '***',
//            'token_secret'  => '***'
//        )));

        echo $client->get('statuses/user_timeline.json')->send()->getBody();
// >>> {"public_gists":6,"type":"User" ...

// Create a tweet using POST
        $request = $client->post('statuses/update.json', null, array(
            'status' => 'Tweeted with Guzzle, http://guzzlephp.org'
        ));

// Send the request and parse the JSON response into an array
        $data = $request->send()->json();
        echo $data['text'];
// >>> Tweeted with Guzzle, http://t.co/kngJMfRk
die;



        $result = array
        (
            'verify'    => false,
//            'action'    => 'sync_log',
//            'signature' => 'c9d92470f13da30f2da8f48a4f4e167a'
        );

//        $client = new Client([
//            'base_url' => [
//                'http://api.duoshuo.com/{log}/',
//                ['log' => 'log']
//            ],
//            'defaults' => [
//                'timeout'         => 100,
//                'allow_redirects' => false,
//                'proxy'           => $request->getClientIp()
//            ]
//        ]);
        $client = new Client();
        $response = $client->get('http://api.duoshuo.com/log/list.json', $result);

        print_r($response->json());
die;

        $logger->info(__CLASS__.'|'.__FUNCTION__."|action={$action}|signature={$signature}");
        return new JsonResponse($response);
    }
} 
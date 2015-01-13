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
use Demo\StoreBundle\Entity\Users;
use Demo\StoreBundle\Entity\Comments;
/**
 * Class SyncController
 * @Route("/sync")
 * @package Demo\WebBundle\Controller
 */
class SyncController extends Controller
{

    private function getUrlContent($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $data = curl_exec($ch);
//        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $data;
    }

    /**
     * 同步评论数据
     * @Route("/comments")
     * @param Request $request
     * @return JsonResponse
     */
    public function commentsAction( Request $request )
    {
        $logger = $this->get('logger');
        $logs = '';

        // http://api.duoshuo.com/log/list.json?short_name=api&secret=c9d92470f13da30f2da8f48a4f4e167a
        $action     = $request->get('action');
        $signature  = $request->get('signature');

        $repository = $this->getDoctrine()->getRepository('DemoStoreBundle:Comments');

        $comment = $repository->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()->getResult();
        $sinceId = 0;
        if( $comment )
        {
            $sinceId = $comment[0]->getCommentLogId();
        }

        $url = "http://api.duoshuo.com/log/list.json?short_name=lattecake&secret=c9d92470f13da30f2da8f48a4f4e167a&since_id={$sinceId}&limit=&order=asc";
        $response = $this->getUrlContent($url);
//        $response = '{"response":[{"log_id":"1259580729570885633","user_id":"661480","action":"create","meta":{"post_id":"1259580729570885704","thread_id":"1259580729570885633","thread_key":"请将此处替换成文章在你的站点中的ID","author_id":"661480","author_key":null,"author_name":"聪_cowa","author_email":"","author_url":"http:\/\/weibo.com\/solacowa","ip":"113.45.197.18","created_at":"2015-01-11T11:50:16+08:00","message":"测试 \"[哈哈]\" ","status":"approved","type":"","parent_id":"1259580729570885632","agent":"Mozilla\/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/41.0.2267.0 Safari\/537.36"},"date":1420948216},{"log_id":"1259580729570885634","user_id":"661480","action":"create","meta":{"post_id":"1259580729570885706","thread_id":"1259580729570885634","thread_key":"guestBook","author_id":"661480","author_key":null,"author_name":"聪_cowa","author_email":"","author_url":"http:\/\/weibo.com\/solacowa","ip":"113.45.197.18","created_at":"2015-01-11T23:20:31+08:00","message":"测试测试 \"[嘻嘻]\" ","status":"approved","type":"","parent_id":"1259580729570885632","agent":"Mozilla\/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/41.0.2267.0 Safari\/537.36"},"date":1420989631},{"log_id":"1259580729570885635","user_id":"661480","action":"delete","meta":["1259580729570885704"],"date":1420989661},{"log_id":"1259580729570885636","user_id":"661480","action":"create","meta":{"post_id":"1259580729570885707","thread_id":"1259580729570885634","thread_key":"guestBook","author_id":"661480","author_key":null,"author_name":"聪_cowa","author_email":"","author_url":"http:\/\/weibo.com\/solacowa","ip":"113.45.197.18","created_at":"2015-01-11T23:21:18+08:00","message":"回一个试试看","status":"approved","type":"","parent_id":"1259580729570885706","agent":"Mozilla\/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/41.0.2267.0 Safari\/537.36"},"date":1420989678},{"log_id":"1259580729570885637","user_id":"661480","action":"create","meta":{"post_id":"1259580729570885708","thread_id":"1259580729570885635","thread_key":"2","author_id":"661480","author_key":null,"author_name":"聪_cowa","author_email":"","author_url":"http:\/\/weibo.com\/solacowa","ip":"101.254.182.4","created_at":"2015-01-12T11:19:03+08:00","message":"嗯 不错不错。 \"[亲亲]\" ","status":"approved","type":"","parent_id":"1259580729570885632","agent":"Mozilla\/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/41.0.2267.0 Safari\/537.36"},"date":1421032743},{"log_id":"1259580729570885638","user_id":"661480","action":"create","meta":{"post_id":"1259580729570885709","thread_id":"1259580729570885635","thread_key":"2","author_id":"661480","author_key":null,"author_name":"聪_cowa","author_email":"","author_url":"http:\/\/weibo.com\/solacowa","ip":"101.254.182.4","created_at":"2015-01-12T13:28:29+08:00","message":"测试测试","status":"approved","type":"","parent_id":"1259580729570885632","agent":"Mozilla\/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/41.0.2267.0 Safari\/537.36"},"date":1421040509},{"log_id":"1259580729570885639","user_id":"661480","action":"delete","meta":["1259580729570885709"],"date":1421040569},{"log_id":"1259580729570885640","user_id":"661480","action":"create","meta":{"post_id":"1259580729570885710","thread_id":"1259580729570885635","thread_key":"2","author_id":"661480","author_key":null,"author_name":"聪_cowa","author_email":"","author_url":"http:\/\/weibo.com\/solacowa","ip":"101.254.182.4","created_at":"2015-01-12T13:29:35+08:00","message":" \"[哈哈]\" 再次测试一下","status":"approved","type":"","parent_id":"1259580729570885632","agent":"Mozilla\/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/41.0.2267.0 Safari\/537.36"},"date":1421040575},{"log_id":"1259580729570885641","user_id":"511031","action":"create","meta":{"post_id":"1259580729570885711","thread_id":"1259580729570885634","thread_key":"guestBook","author_id":"511031","author_key":"0","author_name":"sina乐居_Davia何","author_email":"","author_url":"http:\/\/weibo.com\/2309395567","ip":"210.51.19.2","created_at":"2015-01-12T16:49:28+08:00","message":"我们的开始，是看长的电影！","status":"approved","type":"","parent_id":"1259580729570885632","agent":"Mozilla\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/31.0.1650.63 Safari\/537.36 SE 2.X MetaSr 1.0"},"date":1421052568},{"log_id":"1259580729570885642","user_id":"998978","action":"create","meta":{"post_id":"1259580729570885712","thread_id":"1259580729570885634","thread_key":"guestBook","author_id":"998978","author_key":"0","author_name":"beacya","author_email":"","author_url":"http:\/\/weibo.com\/2023358031","ip":"106.120.139.2","created_at":"2015-01-12T16:49:42+08:00","message":"拿什么做的啊 好看！","status":"approved","type":"","parent_id":"1259580729570885632","agent":"Mozilla\/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/39.0.2171.95 Safari\/537.36"},"date":1421052582},{"log_id":"1259580729570885643","user_id":"511031","action":"create","meta":{"post_id":"1259580729570885714","thread_id":"1259580729570885634","thread_key":"guestBook","author_id":"511031","author_key":"0","author_name":"sina乐居_Davia何","author_email":"","author_url":"http:\/\/weibo.com\/2309395567","ip":"210.51.19.2","created_at":"2015-01-12T16:50:03+08:00","message":"哟，还是实时的啊！","status":"approved","type":"","parent_id":"1259580729570885632","agent":"Mozilla\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/31.0.1650.63 Safari\/537.36 SE 2.X MetaSr 1.0"},"date":1421052603},{"log_id":"1259580729570885644","user_id":"511031","action":"create","meta":{"post_id":"1259580729570885715","thread_id":"1259580729570885634","thread_key":"guestBook","author_id":"511031","author_key":"0","author_name":"sina乐居_Davia何","author_email":"","author_url":"http:\/\/weibo.com\/2309395567","ip":"210.51.19.2","created_at":"2015-01-12T16:51:25+08:00","message":"反同步?","status":"approved","type":"","parent_id":"1259580729570885632","agent":"Mozilla\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/31.0.1650.63 Safari\/537.36 SE 2.X MetaSr 1.0"},"date":1421052685},{"log_id":"1259580729570885645","user_id":"10437600","action":"create","meta":{"post_id":"1259580729570885717","thread_id":"1259580729570885634","thread_key":"guestBook","author_id":"10437600","author_key":"0","author_name":"董继成","author_email":"","author_url":"http:\/\/t.qq.com\/p_pvacb","ip":"124.193.193.25","created_at":"2015-01-12T16:51:44+08:00","message":"很好很强大","status":"approved","type":"","parent_id":"1259580729570885632","agent":"Mozilla\/5.0 (Windows NT 5.1; rv:34.0) Gecko\/20100101 Firefox\/34.0"},"date":1421052704},{"log_id":"1259580729570885646","user_id":"661480","action":"create","meta":{"post_id":"1259580729570885718","thread_id":"1259580729570885634","thread_key":"guestBook","author_id":"661480","author_key":null,"author_name":"聪_cowa","author_email":"","author_url":"http:\/\/weibo.com\/solacowa","ip":"101.254.182.4","created_at":"2015-01-12T16:54:08+08:00","message":"嗯，用的多说，很强大。","status":"approved","type":"","parent_id":"1259580729570885714","agent":"Mozilla\/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/41.0.2267.0 Safari\/537.36"},"date":1421052848},{"log_id":"1259580729570885647","user_id":"661480","action":"create","meta":{"post_id":"1259580729570885719","thread_id":"1259580729570885634","thread_key":"guestBook","author_id":"661480","author_key":null,"author_name":"聪_cowa","author_email":"","author_url":"http:\/\/weibo.com\/solacowa","ip":"101.254.182.4","created_at":"2015-01-12T16:54:27+08:00","message":"你在其他用了 多说的网站也可以看到我的回复 \"[哈哈]\" ","status":"approved","type":"","parent_id":"1259580729570885715","agent":"Mozilla\/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/41.0.2267.0 Safari\/537.36"},"date":1421052867},{"log_id":"1259580729570885648","user_id":"661480","action":"create","meta":{"post_id":"1259580729570885720","thread_id":"1259580729570885634","thread_key":"guestBook","author_id":"661480","author_key":null,"author_name":"聪_cowa","author_email":"","author_url":"http:\/\/weibo.com\/solacowa","ip":"101.254.182.4","created_at":"2015-01-12T16:55:04+08:00","message":"bootstrap啊","status":"approved","type":"","parent_id":"1259580729570885712","agent":"Mozilla\/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/41.0.2267.0 Safari\/537.36"},"date":1421052904},{"log_id":"1259580729570885649","user_id":"4714359","action":"create","meta":{"post_id":"1259580729570885721","thread_id":"1259580729570885634","thread_key":"guestBook","author_id":"4714359","author_key":"0","author_name":"隱懓","author_email":"","author_url":"http:\/\/weibo.com\/1800363354","ip":"101.254.182.4","created_at":"2015-01-12T19:33:51+08:00","message":"哇塞，吼吼吼 \"[哈哈]\" ","status":"approved","type":"","parent_id":"1259580729570885632","agent":"Mozilla\/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/39.0.2171.95 Safari\/537.36"},"date":1421062431},{"log_id":"1259580729570885650","user_id":"661480","action":"create","meta":{"post_id":"1259580729570885722","thread_id":"1259580729570885634","thread_key":"guestBook","author_id":"661480","author_key":null,"author_name":"拿铁味的摩卡蛋糕","author_email":"sola_cowa@sina.com","author_url":"http:\/\/weibo.com\/solacowa","ip":"113.45.197.18","created_at":"2015-01-12T23:04:44+08:00","message":"嘿 嘿","status":"approved","type":"","parent_id":"1259580729570885721","agent":"Mozilla\/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/41.0.2267.0 Safari\/537.36"},"date":1421075084}],"code":0}';

        $userArr = $commentArr = [];

        $result = json_decode( $response );

        $logs .= "|code={$result->code}";

        if( $result->code == 0  )
        {
            foreach( $result->response as $key => $row )
            {
                $users    = new Users();
                $comments = new Comments();

                $userDoctrine = $this->getDoctrine()
                    ->getRepository('DemoStoreBundle:Users');
                $commentDoctrine = $this->getDoctrine()
                    ->getRepository('DemoStoreBundle:Comments');
                $em = $this->getDoctrine()->getManager();

                $meta = $row->meta;

                $userInfo = $userDoctrine->findOneBy(array('user_duoId' => $row->user_id));
                if( !$userInfo )
                {
                    $rand = md5(time() . mt_rand(0,1000));

                    $users->setUserDuoId($row->user_id);
                    $users->setUserEmail($meta->author_email);
                    $users->setUserNiceName($meta->author_name);
                    $users->setUserKey($meta->author_key);
                    $users->setUserUrl($meta->author_url);
                    $users->setUserTime(strtotime($meta->created_at));
                    $users->setUserLogin($meta->author_email);
                    $users->setUserPass($rand);

                    $em->persist($users);
                    $em->flush();
                    $userArr[] = $users->getId();
                }
                $commentInfo = $commentDoctrine->findOneBy(array( 'comment_logId' => $row->log_id ));
                if( !$commentInfo && $row->action != 'delete' )
                {
                    $comments->setCommentLogId($row->log_id);
                    $comments->setCommentAction($row->action);
                    $comments->setCommentUserId($row->user_id);
                    $comments->setCommentIp($meta->ip);
                    $comments->setCommentCreatedAt(strtotime($meta->created_at));
                    $comments->setCommentMessage($meta->message);
                    $comments->setCommentThreadKey($meta->thread_key);
                    $comments->setCommentPostId($meta->post_id);
                    $comments->setCommentType($meta->type);
                    $comments->setCommentParentId($meta->parent_id);
                    $comments->setCommentStatus($meta->status);
                    $comments->setCommentThreadId($meta->thread_id);
                    $comments->setCommentAgent($meta->agent);
                    $em->persist($comments);

                    $em->flush();
                    $commentArr[] = $comments->getId();
                }else
                {
                    if( $row->action == 'delete' )
                    {
                        $comments->setCommentAction($row->action);
                        $em->flush();
                    }
                }
            }

        }

        $response = array
        (
            'users' => $userArr,
            'comments' => $commentArr
        );
        /*
        // Create a client to work with the Twitter API
        $client = new Client();
        $req = $client->get('http://api.duoshuo.com/log/list.json', ['verify' => false]);
        */

        $context = [
            'action'    => $action,
            'signature' => $signature,
            'apiCode'   => $result->code
        ];

        $logger->info(__CLASS__.':'.__FUNCTION__, $context);
//        $logger->log(200, __CLASS__.'|'.__FUNCTION__."|action={$action}|signature={$signature}{$logs}");
        return new JsonResponse($response);
    }



} 
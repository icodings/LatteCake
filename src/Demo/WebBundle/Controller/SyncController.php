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
//use GuzzleHttp\Client;
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

        $url = "http://api.duoshuo.com/log/list.json?short_name=lattecake&secret=c9d92470f13da30f2da8f48a4f4e167a&since_id={$sinceId}&limit=100&order=asc";
        $response = $this->getUrlContent($url);

        $userArr = $commentArr = [];

        $result = json_decode( $response );

        $context = [
            'action'    => $action,
            'signature' => $signature,
            'apiCode'   => $result->code
        ];

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
                if( !$commentInfo && in_array($row->action, array('create', 'approve')) )
                {
                    $postId = $meta->thread_key;
                    if( is_string($meta->thread_key) && $meta->thread_key != 'guestBook' )
                    {
                        $postArr = explode('_', $meta->thread_key);
                        $postId  = $postArr[1];
                    }

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
                    $comments->setCommentArticleId($postId);
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

        }else
        {
            $context['response'] = json_decode($response, true);
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

        $logger->info(__CLASS__.'::'.__FUNCTION__, $context);
//        $logger->log(200, __CLASS__.'|'.__FUNCTION__."|action={$action}|signature={$signature}{$logs}");
        return new JsonResponse($response);
    }



} 
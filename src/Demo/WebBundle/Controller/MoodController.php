<?php
/**
 * Created by PhpStorm.
 * User: cong
 * Date: 14-12-21
 * Time: 下午2:23
 */

namespace Demo\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Demo\StoreBundle\Entity\Mood;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
/**
 * Class MoodController
 * @Route("/mood")
 * @package Demo\WebBundle\Controller
 */
class MoodController extends Controller
{

    const PAGE_NUM = 15;

    /**
     * 删除碎言碎语
     *
     * @Route("/delMood")
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function delMoodAction( Request $request )
    {
        if( $request->isXmlHttpRequest() && $request->getMethod() == 'POST')
        {
            $jsonResponse = array
            (
                'success'   => true,
                'errorCode' => '000000',
                'message'   => '成功'
            );
            $moodId = $request->get('id');

            if( empty( $moodId ) )
            {
                $jsonResponse['success']   = false;
                $jsonResponse['errorCode'] = '100002';
                $jsonResponse['message']   = 'MoodId 不能为空';
                return new JsonResponse( $jsonResponse );
            }
            $em = $this->getDoctrine()->getEntityManager();
            $moodInfo = $em->getRepository('DemoStoreBundle:Mood')->find($moodId);

            if (!$moodInfo) {
                $jsonResponse['success']   = false;
                $jsonResponse['errorCode'] = '100003';
                $jsonResponse['message']   = '没有找到该条记录';
                return new JsonResponse( $jsonResponse );
            }

            $em->remove($moodInfo);
            $em->flush();

            return new JsonResponse( $jsonResponse );
        }else
        {
            return new RedirectResponse( $this->generateUrl('main_index') );
        }
    }

    /**
     * 添加新的 碎语
     * @Route("/newMood")
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function newMoodAction( Request $request )
    {
        if( $request->isXmlHttpRequest() && $request->getMethod() == 'POST' )
        {
            $logger = $this->get('logger');
            $jsonResponse = array
            (
                'success'   => true,
                'errorCode' => '000000',
                'message'   => '成功'
            );
            $moodContent = $request->get('moodContent');
            $moodId      = intval( $request->get('moodId') );

            $logger->info(__CLASS__.'|'.__FUNCTION__."|moodId={$moodId}|moodContent={$moodContent}");
            if( empty( $moodContent ) )
            {
                $jsonResponse['success']   = false;
                $jsonResponse['errorCode'] = '100001';
                $jsonResponse['message']   = '参数不能为空';
                return new JsonResponse( $jsonResponse );
            }
            $moodTitle = trim( $request->get('moodTitle') );
            $mood = new Mood();

            $em = $this->getDoctrine()->getManager();
            if( empty( $moodId ) )
            {
                $mood->setMoodContent( $moodContent );
                $mood->setMoodTitle( $moodTitle );
                $mood->setMoodTime(time());
                $mood->setMoodAuthor( 1 );

                $em->persist($mood);
                $em->flush();
            }else{
                $mood = $em->getRepository('DemoStoreBundle:Mood')->find($moodId);
                $mood->setMoodContent( $moodContent );
                $mood->setMoodTitle( $moodTitle );
                if (!$mood) {
                    $jsonResponse['success']   = false;
                    $jsonResponse['errorCode'] = '100002';
                    $jsonResponse['message']   = '不存在该碎语';
                    return new JsonResponse( $jsonResponse );
                }
                $em->flush();
            }
            $jsonResponse['data'] = array
            (
                'moodId' => $mood->getId()
            );

            return new JsonResponse( $jsonResponse );
        }else
        {
            return new RedirectResponse( $this->generateUrl('main_index') );
        }
    }

    /**
     * 获取碎语列表
     * @Route("/list", name="mood_list", defaults={"page":1}, requirements={"page"="\d+"})
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function listAction( Request $request )
    {
        $logger = $this->get('logger');

//        $logger->err('An error occurred');
        if( $request->isXmlHttpRequest() )
        {
            $page = $request->get( 'page' );
            $first = ($page - 1) * self::PAGE_NUM;

            $logger->info(__CLASS__.'|'.__FUNCTION__."|page={$page}|first={$first}");

            $repository = $this->getDoctrine()->getRepository('DemoStoreBundle:Mood');

            $moods = $repository->createQueryBuilder('m')
                ->orderBy('m.id', 'DESC')
                ->setFirstResult($first)
                ->setMaxResults(self::PAGE_NUM)
                ->getQuery()->getResult();

            $list = array();
            if( !empty( $moods ) )
            {
                foreach( $moods as $value )
                {
                    $moodTitle = $this->str_limiter($value->getMoodTitle(), 24);
                    $list[] = array
                    (
                        'moodTime'    => date('Y/m/d H:i',$value->getMoodTime()),
                        'moodContent' => $value->getMoodContent(),
                        'moodAuthor'  => 'Mocha',
                        'moodId'      => $value->getId(),
                        'moodTitle'   => $moodTitle ? $moodTitle : date('Y-m-d H:i', $value->getMoodTime())
                    );
                }
            }

            $data = array
            (
                'success'   => true,
                'data'      => $list,
                'errorCode' => '000000',
                'message'   => 'SUCCESS'
            );

            return new JsonResponse($data);
        }else
        {
            return new RedirectResponse( $this->generateUrl('main_index') );
        }
    }

    /**
     * 字符串截取
     * @param $str
     * @param $subLen
     * @param string $etc
     * @return string
     */
    public function str_limiter($str, $subLen, $etc = '...')
    {
        if(strlen($str) <= $subLen) {
            $rStr = $str;
        } else {
            $StringLast = array();
            $I = 0;
            while ($I < $subLen) {
                $StringTMP = substr($str, $I, 1);
                if (ord($StringTMP) >= 224) {
                    $StringTMP = substr($str, $I, 3);
                    $I = $I + 3;
                } elseif (ord($StringTMP) >= 192) {
                    $StringTMP = substr($str, $I, 2);
                    $I = $I + 2;
                } else {
                    $I = $I + 1;
                }
                $StringLast[] = $StringTMP;
            }

            $rStr = implode('',$StringLast).$etc;
        }

        return $rStr;
    }
} 
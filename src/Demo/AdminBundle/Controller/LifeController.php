<?php
/**
 * Created by PhpStorm.
 * User: cong
 * Date: 15-1-24
 * Time: 下午6:28
 */

namespace Demo\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Demo\StoreBundle\Entity\Life;
use Demo\StoreBundle\Entity\Image;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

/**
 * Class LifeController
 * @Route("/admin/life")
 * @package Demo\AdminBundle\Controller
 */
class LifeController extends Controller
{

    /**
     * 添加"慢生活"内容页面
     * @Route("/lifeEdit")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editLifeAction()
    {
        return $this->render('DemoAdminBundle:Life:lifeEditor.html.twig');
    }

    /**
     * 添加内容
     * @Route("/newLife")
     * @param Request $request
     * @return JsonResponse
     */
    public function newLifeAction( Request $request )
    {
        $lifeTitle   = $request->get('lifeTitle');
        $lifeDesc    = $request->get('lifeDesc');
        $lifeContent = $request->get('lifeContent');
        $lifeSource  = $request->get('lifeSource');
        $lifeKeyword = $request->get('lifeKeyword');
        $lifeTag     = $request->get('lifeTag');

        $response = [
            'success'   => true,
            'errorCode' => '',
            'message'   => '操作成功',
            'data'      => ''
        ];

        if( !$request->files )
        {
            $response['success'] = false;
            $response['message'] = '图片不能为空！';
            return new JsonResponse($response);
        }
        $imageName = '';
//        $fileUrl = $this->container->getParameter('qiNiuUrl');
        if( $request->files )
        {
            $dir = './uploads/images/'.date('Y/m/');
            foreach ($request->files as $file)
            {
                $name = md5( $file->getClientOriginalName(). microtime() ).'.'.$file->guessExtension();
                $fs = new Filesystem();
                if( !$fs->exists( $dir ) )
                {
                    try {
                        $fs->mkdir( $dir );
                    } catch (IOExceptionInterface $e) {
                        echo "An error occurred while creating your directory at ".$e->getPath();
                    }
                }
                $imageName = $name;
                $file->move( $dir,  $name );
                break;
            }
        }

        if( !empty( $lifeContent ) && !empty($lifeDesc) && !empty( $lifeTitle ))
        {
            $life = new Life();

            $em = $this->getDoctrine()->getManager();

            $life->setLifeTitle($lifeTitle);
            $life->setLifeRead(1);
            $life->setLifeAuthor(1);
            $life->setLifeContent($lifeContent);
            $life->setLifeDesc($lifeDesc);
            $life->setLifeImage($imageName);
            $life->setLifeLastTime(time());
            $life->setLifeTime(time());
            $life->setLifeSource($lifeSource);
            $em->persist($life);
            $em->flush();
        }

        return new JsonResponse($response);
    }
} 
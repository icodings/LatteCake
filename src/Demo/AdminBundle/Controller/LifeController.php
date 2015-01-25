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
use Symfony\Component\Filesystem\Filesystem;

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
        $lifeImage   = $request->get('lifeImage');
        $lifeDesc    = $request->get('lifeDesc');
        $lifeContent = $request->get('lifeContent');
        $lifeSource  = $request->get('lifeSource');
        $lifeKeyword = $request->get('lifeKeyword');
        $lifeTag     = $request->get('lifeTag');

/*        $fileSystem = $this->get('');
print_r( $fileSystem );die;
print_r($fileSystem->getClientOriginalName());die;

        $dir = $this->get('kernel')->getRootDir() . '/../web/';


        $sub_path = md5( $fileObject->getClientOriginalName() . microtime() );

        $dir .= '/' . $sub_path . '/';
        $fs = new Filesystem();

        if( !$fs->exists( $dir ) )
        {
            try {
                $fs->mkdir( $dir );
            } catch (IOExceptionInterface $e) {
                echo "An error occurred while creating your directory at ".$e->getPath();
            }
        }

        $file = str_replace( 'image/' , mt_rand(1,99) .'.' , $fileObject->getMimeType() );

        $fileObject->move( $dir , $file );

        return '/'.$path.'/' . $sub_path . '/' . $file;
*/


        /*$filesystem = new Filesystem();

        $filesystem->copy($originFile, $targetFile, $override = false);

        $filesystem->mkdir($dirs, $mode = 0777);

        $filesystem->touch($files, $time = null, $atime = null);

        $filesystem->remove($files);

        $filesystem->chmod($files, $mode, $umask = 0000, $recursive = false);

        $filesystem->chown($files, $user, $recursive = false);

        $filesystem->chgrp($files, $group, $recursive = false);

        $filesystem->rename($origin, $target);

        $filesystem->symlink($originDir, $targetDir, $copyOnWindows = false);

        $filesystem->makePathRelative($endPath, $startPath);

        $filesystem->mirror($originDir, $targetDir, \Traversable $iterator = null, $options = array());

        $filesystem->isAbsolutePath($file);*/



        if( !empty( $lifeContent ) && !empty($lifeDesc) && !empty( $lifeTitle ))
        {
            $life = new Life();

            $em = $this->getDoctrine()->getManager();

            $life->setLifeTitle($lifeTitle);
            $life->setLifeRead(1);
            $life->setLifeAuthor(1);
            $life->setLifeContent($lifeContent);
            $life->setLifeDesc($lifeDesc);
            $life->setLifeImage('http://pic3.zhimg.com/236ab287d61dc6b172a0a6b0dc3295de.jpg');
            $life->setLifeLastTime(time());
            $life->setLifeTime(time());

            $em->persist($life);
            $em->flush();
        }
        $response = [
            'success'   => true,
            'errorCode' => '',
            'message'   => '操作成功',
            'data'      => array
            (
                'lifeTitle' => $lifeTitle
            )
        ];
        return new JsonResponse($response);
    }
} 
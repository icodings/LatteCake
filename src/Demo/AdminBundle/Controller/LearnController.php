<?php
/**
 * Created by PhpStorm.
 * User: cong
 * Date: 15-1-27
 * Time: 下午1:40
 */

namespace Demo\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Demo\StoreBundle\Entity\Posts;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

/**
 * Class LearnController
 * @Route("/admin/learn")
 * @package Demo\AdminBundle\Controller
 */
class LearnController extends Controller
{
    /**
     * 添加文章
     * @Route("/newLearn")
     *
     * @param Request $request
     * @return Response|JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function newLearnAction( Request $request )
    {
        if( !$request->files )
        {
            $response['success'] = false;
            $response['message'] = '图片不能为空！';
            return new JsonResponse($response);
        }
        if( !$request->get('learnTitle') || !$request->get('learnContent') || !$request->get('learnDesc') )
        {
            $response['success'] = false;
            $response['message'] = '其他参数不能为空！';
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
//                $fileUrl = $fileUrl.date('Y/m/').$name;
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

        $posts = new Posts();
        $posts->setPostAuthor(1);
        $posts->setPostTime(time());
        $posts->setPostImage($imageName);
        $posts->setPostTitle( $request->get('learnTitle') );
        $posts->setPostContent( $request->get('learnContent') );
        $posts->setPostDesc( $request->get('learnDesc'));
        $posts->setPostReadNum(1);
        $posts->setPostAction(0);

        /*$form = $this->createFormBuilder( $posts )
            ->add('learnTitle', 'text')
            ->add('learnContent', 'text')
            ->add('learnDesc', 'textarea')
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if(!$form->isValid()){
            return new Response(json_encode('非法的更新请求!'),400);
        }*/
        $em = $this->getDoctrine()->getManager();
        $em->persist($posts);
        $em->flush();

        $response = [
            'success'   => true,
            'errorCode' => '',
            'message'   => '操作成功',
            'data'      => ''
        ];
        return new JsonResponse($response);
    }
} 
<?php
/**
 * Created by PhpStorm.
 * User: cong
 * Date: 14-12-11
 * Time: 下午4:41
 */

namespace Demo\WebBundle\Controller;


use Demo\StoreBundle\Entity\Posts;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PostController
 * @Route("/post")
 * @package Demo\WebBundle\Controller
 */
class PostController extends Controller
{

    /**
     * 添加文章
     * @Route("/addPost", name="post_addPost")
     */
    public function addPostAction( Request $request )
    {
        if($request->getMethod() != "POST"){
            $this->redirect($this->generateUrl('main_index'));
        }else
        {
            $posts = new Posts();

            $posts->setPostTime(time());
            $posts->setPostTitle( $request->get('post_title') );
            $posts->setPostContent( $request->get('post_content') );
            $posts->setPostDesc( $request->get('post_desc'));
            $posts->setPostAuthor( 1 );

            $form = $this->createFormBuilder( $posts )
                ->add('post_title', 'text')
                ->add('post_desc', 'text')
                ->add('post_content', 'textarea')
                ->add('save', 'submit')
                ->getForm();

            $form->handleRequest($request);

            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();
                $em->persist($posts);
                $em->flush();

                $nextAction = $form->get('save')->isClicked()
                    ? 'learn_bootstrap'
                    : 'main_index';
                return $this->redirect($this->generateUrl($nextAction));
            }else
            {
                return  new Response(json_encode('非法的更新请求!'),400);
            }
        }
    }

    /**
     * 获取文章详情
     *
     * @Route("/postInfo/{id}", name="post_postInfo")
     * @param Posts $postInfo
     * @param Request $request
     * @ParamConverter("posts", class="DemoStoreBundle:Posts")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function postInfoAction( Posts $postInfo, Request $request )
    {
        if (!$postInfo) {
            throw $this->createNotFoundException('No product found for id '.$request->get('id'));
        }

        $data = array
        (
            'postInfo' => $postInfo,
            'title'    => $postInfo->getPostTitle()
        );

        return $this->render('DemoWebBundle:Post:postInfo.html.twig', $data );
    }
} 
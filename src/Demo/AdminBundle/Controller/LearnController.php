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
        $posts = new Posts();
        $posts->setPostAuthor(1);
        $posts->setPostTime(time());
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
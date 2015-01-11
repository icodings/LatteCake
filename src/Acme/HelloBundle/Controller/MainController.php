<?php
/**
 * Created by PhpStorm.
 * User: cong
 * Date: 14-11-20
 * Time: 下午6:22
 */

namespace Acme\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Acme\StoreBundle\Entity\Article;

/**
 * Class MainController
 * @Route("/")
 * @package Acme\HelloBundle\Controller
 */
class MainController extends Controller
{
    /**
     * 首页显示列表
     * @Route("/")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {

        $articleList = $this->getDoctrine()
            ->getRepository('AcmeStoreBundle:Article')->findAll();
        $list = array();
        if( !empty($articleList) )
        {
            foreach( $articleList as $key => $value )
            {
                $list[] = array
                (
                    'id'    => $value->getId(),
                    'title' => $value->getArticleTitle(),
                );
            }
        }
        $form = $this->createFormBuilder()
            ->add('article_title', 'text', array( 'label' => '标题' ))
            ->add('article_content', 'textarea', array( 'label' => '内容' ))
            ->add('article_cTime', 'date', array( 'label' => '时间' ))
            ->add('save', 'submit', array('label' => '保存'))
            ->getForm();

        $data = array
        (
            'title' => 'Main测试标题',
            'list'  => $list,
            'form'  => $form->createView()
        );
        return $this->render('AcmeHelloBundle:Main:index.html.twig', $data );
    }

    /**
     * 显示文章页面
     * @Route("/show/{id}")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function showAction( $id )
    {
        $article = $this->getDoctrine()
            ->getRepository('AcmeStoreBundle:Article')
            ->find($id);
        if (!$article) {
            throw $this->createNotFoundException('该文章不存在');
        }

//        $session = $this->getRequest()->getSession();
//        $session->set('foo', 'bar');
//        $foo = $session->get('foo');

        $data = array
        (
            'title'   => $article->getArticleTitle(),
            'content' => $article->getArticleContent(),
            'cTime'   => $article->getArticleCTime()
        );
        return $this->render('AcmeHelloBundle:Main:show.html.twig', $data );
    }

    /**
     * 获取导航栏
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function navigationAction()
    {
        return $this->render('AcmeHelloBundle:Public:navigation.html.twig');
    }

    public function formIndexTask()
    {
//        $task = new Task();
//        $task->setTask('Write a blog post');
//        $task->setDueDate(new \DateTime('tomorrow'));


    }




    /**
     * 关于 的页面
     * @Route("/about")
     */
    public function about()
    {

    }
} 
<?php
/**
 * Created by PhpStorm.
 * User: cong
 * Date: 14-12-9
 * Time: 下午4:55
 */

namespace Demo\WebBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Demo\StoreBundle\Entity\Mood;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class MainController
 * @Route("/")
 * @package Demo\WebBundle\Controller
 */
class MainController extends Controller
{

    const PAGE_NUM = 15;

    /**
     * 首页
     * @Route("/", name="main_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {

        //return new RedirectResponse( 'index.html' );

        $form = $this->createFormBuilder()
            ->add('post_title', 'text', array( 'label' => '标题: ' ))
            ->add('post_desc', 'text', array( 'label' => '简介: ' ))
            ->add('post_content', 'textarea', array( 'label' => '内容: ' ))
            ->add('save', 'submit', array('label' => '保存'))
            ->getForm();

        $data = array
        (
            'form'  => $form->createView()
        );
        return $this->render('DemoWebBundle:Main:index.html.twig', $data );
    }

    /**
     * 关于我页面
     * @Route("/about", name="main_about")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function aboutAction()
    {
        return $this->render('DemoWebBundle:Main:about.html.twig' );
    }

    /**
     * 碎言碎语
     * @Route("/mood", name="main_mood")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function moodAction( Request $request )
    {
        $logger = $this->get('logger');

        $page = $request->get( 'page' ) ? $request->get('page') : 1;
        $first = ($page - 1) * self::PAGE_NUM;

        $logger->info(__CLASS__.'|'.__FUNCTION__."|page={$page}|first={$first}");

        $repository = $this->getDoctrine()->getRepository('DemoStoreBundle:Mood');

        $moods = $repository->createQueryBuilder('m')
            ->orderBy('m.id', 'DESC')
            ->setFirstResult($first)
            ->setMaxResults(self::PAGE_NUM)
            ->getQuery()->getResult();

        $data = array
        (
            'moods' => $moods
        );

        return $this->render('DemoWebBundle:Main:mood.html.twig', $data );
    }

    /**
     * 慢生活
     * @Route("/life", name="main_life")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function lifeAction()
    {
        return $this->render('DemoWebBundle:Main:life.html.twig' );
    }

    /**
     * 留言板
     * @Route("/guestBook", name="main_guestBook")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function guestBookAction()
    {
        return $this->render('DemoWebBundle:Main:guestBook.html.twig');
    }

}
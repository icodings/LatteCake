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
use Demo\StoreBundle\Entity\Posts;
use Demo\StoreBundle\Entity\Life;
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
    const PAGE_NUM10 = 10;

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
     * 学无止境
     * @Route("/learn", name="main_learn", defaults={"page":1}, requirements={"page"="\d+"})
     * @param $page
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function learnAction($page, Request $request)
    {
        $first = ($page - 1) * self::PAGE_NUM;
        $repository = $this->getDoctrine()
            ->getRepository('DemoStoreBundle:Posts');
        $posts = $repository->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->setMaxResults( self::PAGE_NUM )
            ->setFirstResult( $first )
            ->getResult();

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT COUNT(p.id) AS rowsNum FROM DemoStoreBundle:Posts AS p');
        $resultCount = $query->getResult();

        $data = array
        (
            'title' => 'Bootstrap',
            'posts' => $posts,
            'label' => array('default', 'primary', 'success', 'info', 'warning', 'danger'),
            'total' => ceil( $resultCount[0]['rowsNum'] / self::PAGE_NUM ),
            'page'  => $page
        );
        return $this->render('DemoWebBundle:Main:learn.html.twig', $data );
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
//        $logger = $this->get('logger');

        $em = $this->getDoctrine()->getManager();
        $totalObj = $em->createQuery('SELECT COUNT(m.id) total FROM DemoStoreBundle:Mood m')->getResult();

        $data = array
        (
            'moods' => [],
            'total' => ceil($totalObj[0]['total'] / 15)
        );

        return $this->render('DemoWebBundle:Main:mood.html.twig', $data );
    }

    /**
     * 慢生活
     * @Route("/life/{page}", name="main_life", defaults={"page":1}, requirements={"page"="\d+"})
     * @param $page
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function lifeAction( $page, Request $request )
    {
        $first = ($page - 1) * self::PAGE_NUM10;

        $em = $this->getDoctrine()->getManager();
        $list = $em->createQuery("SELECT l.id lId,l.life_desc,l.life_author,l.life_time,l.life_image,l.life_title,u.id uId,u.user_niceName,u.user_url
              FROM DemoStoreBundle:Life l
              INNER JOIN DemoStoreBundle:Users u WITH l.life_author = u.id
              ORDER BY l.life_time DESC")
            ->setMaxResults( self::PAGE_NUM10 )
            ->setFirstResult( $first )
            ->getResult();

        if( !$list )
            throw $this->createNotFoundException('No product found');

        $resultCount = $em->createQuery('SELECT COUNT(l.id) rowsNum FROM DemoStoreBundle:Life l')->getResult();

        $response = array
        (
            'lifeList'  => $list,
            'page'      => $page,
            'totalPage' => ceil( $resultCount[0]['rowsNum'] / self::PAGE_NUM10 )
        );

        return $this->render('DemoWebBundle:Main:life.html.twig', $response );
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
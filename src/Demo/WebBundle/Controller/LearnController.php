<?php
/**
 * Created by PhpStorm.
 * User: cong
 * Date: 14-12-14
 * Time: 上午11:29
 */

namespace Demo\WebBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Demo\StoreBundle\Entity\Posts;
use Symfony\Component\HttpFoundation\Request;

/**
 * 学无止境
 * Class LearnController
 * @Route("/learn")
 * @package Demo\WebBundle\Controller
 */
class LearnController extends Controller
{
    const PAGE_NUM = 10;

    /**
     * javascript 页面列表
     * @Route("/javascript", name="learn_javascript")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function javascriptAction()
    {
        $data = array
        (
            'title' => 'JavaScript'
        );
        return $this->render('DemoWebBundle:Learn:javascript.html.twig', $data );
    }

    /**
     * linux页面列表
     * @Route("/linux", name="learn_linux")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function linuxAction()
    {
        $data = array
        (
            'title' => 'Linux'
        );
        return $this->render('DemoWebBundle:Learn:linux.html.twig', $data );
    }

    /**
     * php页面列表
     * @Route("/php", name="learn_php")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function phpAction()
    {
        $data = array
        (
            'title' => 'PHP'
        );
        return $this->render('DemoWebBundle:Learn:php.html.twig', $data );
    }

    /**
     * ruby页面列表
     * @Route("/ruby", name="learn_ruby")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function rubyAction()
    {
        $data = array
        (
            'title' => 'Ruby'
        );
        return $this->render('DemoWebBundle:Learn:ruby.html.twig', $data );
    }


    /**
     * @Route("/bootstrap/{page}", name="learn_bootstrap", defaults={"page":1}, requirements={"page"="\d+"})
     * @param $page
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function bootstrapAction($page, Request $request)
    {
        $first = ($page - 1) * self::PAGE_NUM;
        $repository = $this->getDoctrine()
            ->getRepository('DemoStoreBundle:Posts');
        $posts = $repository->createQueryBuilder('p')
            ->where('p.post_action = 7')
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
        return $this->render('DemoWebBundle:Learn:bootstrap.html.twig', $data );
    }

} 
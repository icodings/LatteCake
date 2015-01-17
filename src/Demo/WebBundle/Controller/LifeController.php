<?php
/**
 * Created by PhpStorm.
 * User: cong
 * Date: 15-1-17
 * Time: 下午5:13
 */

namespace Demo\WebBundle\Controller;


use Demo\StoreBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Demo\StoreBundle\Entity\Life;

/**
 * Class LifeController
 *
 * @Route("/life")
 * @package Demo\WebBundle\Controller
 */
class LifeController extends Controller
{

    /**
     * 文章详情
     * @Route("/lifeInfo/{id}/{page}", name="life_lifeInfo", defaults={"page":1}, requirements={"page"="\d+"})
     * @param $page
     * @param $lifeInfo
     * @ParamConverter("life", class="DemoStoreBundle:Life")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function lifeInfoAction($page, Life $lifeInfo )
    {
        if( !$lifeInfo )
            throw $this->createNotFoundException('No product found');

        $userInfo = $this->getDoctrine()
            ->getRepository('DemoStoreBundle:Users')->find($lifeInfo->getLifeAuthor());

        $data = array
        (
            'lifeInfo' => $lifeInfo,
            'page'     => $page,
            'userInfo' => $userInfo
        );
        return $this->render('DemoWebBundle:Life:lifeInfo.html.twig', $data );
    }
} 
<?php
/**
 * Created by PhpStorm.
 * User: cong
 * Date: 15-1-25
 * Time: 下午4:07
 */

namespace Demo\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

/**
 * Class ImageController
 * @Route("/admin/image")
 * @package Demo\AdminBundle\Controller
 */
class ImageController extends Controller{

    /**
     * 上传图片
     * @Route("/uploadImage")
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadImageAction( Request $request )
    {
        $fileUrl = 'http://demo.lattecake.local/uploads/images/life/';
        if( $request->files )
        {
            $dir = 'E:\website\Git\LatteCake\web\uploads\images\life\\'.date('Y/m/');
            foreach ($request->files as $file)
            {
                $name = md5( $file->getClientOriginalName(). microtime() ).'.'.$file->guessExtension();
                $fileUrl = $fileUrl.date('Y/m/').$name;
                $fs = new Filesystem();
                if( !$fs->exists( $dir ) )
                {
                    try {
                        $fs->mkdir( $dir );
                    } catch (IOExceptionInterface $e) {
                        echo "An error occurred while creating your directory at ".$e->getPath();
                    }
                }
                $file->move( $dir,  $name );
                break;
            }
        }
        $response =  [
            'error' => 0,
            'url'   => $fileUrl
        ];
        return new JsonResponse($response);
    }
} 
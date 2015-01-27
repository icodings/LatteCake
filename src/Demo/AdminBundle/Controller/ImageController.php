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

use ALIOSS;

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
        $fileUrl = 'http://uploads.lattecake.com/images/';
//        $fileUrl = 'http://uploads.lattecake.local/images/life/';
        if( $request->files )
        {
           /* $OSS_access_id  = $this->container->getParameter('OSS_access_id');
            $OSS_access_key = $this->container->getParameter('OSS_access_key');*/

            $dir = './uploads/images/'.date('Y/m/');
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

                /*$oss_sdk_service = new ALIOSS($OSS_access_id, $OSS_access_key);

                //设置是否打开curl调试模式
                $oss_sdk_service->set_debug_mode(TRUE);


                $bucket = 'lattecake';
                $options = array(
                    ALIOSS::OSS_CONTENT_TYPE => 'text/xml'
                );

                //print_r($oss_sdk_service->get_bucket_acl($bucket, $options));die;


                $object = 'netbeans-7.1.2-ml-cpp-linux.sh';
                $file_path = $dir.$name;

                $response = $oss_sdk_service->upload_file_by_file($bucket, $name, $file_path);

                echo '|-----------------------Start---------------------------------------------------------------------------------------------------'."\n";
                echo '|-Status:' . $response->status . "\n";
                echo '|-Body:' ."\n";
                echo $response->body . "\n";
                echo "|-Header:\n";
                print_r ( $response->header );
                echo '-----------------------End-----------------------------------------------------------------------------------------------------'."\n\n";

                die;*/

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
<?php

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Newsfeeds;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Mapping as ORM;

if (!defined('RESPONSE_SUCCESS')) define('RESPONSE_SUCCESS', 0);

if (!defined('RESPONSE_ERROR')) define('RESPONSE_ERROR', 1);

class NewsfeedsServices
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em                               = $em;
    }
    
    /*
      * This method get the newsfeeds data object
      * Then it will format the result base on how we handle it in newsfeeds_details template.
      *
      * @param newsfeedsId
      *
      * @return array of Newsfeeds data object
      * @author Firas Bou Karroum <firas.boukarroum@gmail.com>
      */

    public function getNewsfeedsDetails($newsfeedsId)
    {
        $response = array();
        $newsfeedsDetailObj = $this->em->getRepository('AppBundle:Newsfeeds')->findOneBy([
            'id' => $newsfeedsId,
            'published' => 1,
        ]);

        if ($newsfeedsDetailObj) {		
            $response = $newsfeedsDetailObj->toArray();
        }

        return $this->createJsonResponse($response);
    }    
    

    /**
     * This method is used to format all the methods responses with standard json
     *
     * param array of results
     * @return json return with standard formatting: success, message, code, data
     * @author Firas Bou Karroum <firas.boukarroum@gmail.com>
     */
    private function createJsonResponse($result = array())
    {
        if (empty($result)) {
            $responseArray['success'] = false;
            $responseArray['message'] ='No data returned';
            $responseArray['code']    = '';
            $responseArray['data']    = '';
        } else {
            if (isset($result['errorCode']) && !empty($result['errorCode'])) {
                $responseArray['success'] = false;
                $responseArray['message'] = $result['errorMessage'];
                $responseArray['code']    = $result['errorCode'];
                $responseArray['data']    = '';
            } else {
                $responseArray['success'] = true;
                $responseArray['message'] = '';
                $responseArray['code']    = '';
                $responseArray['data']    = $result;
            }
        }
        $response = new Response(json_encode($responseArray));
        $response->headers->set('Content-Type', 'application/json');

        return json_encode($responseArray);
    }
        
    /**
     * This method will retrieve the news feeds from DB and can be used for pagination
     * If the unlimited is set then we get all news feeds otherwise we get only first 20
     * 
     * @param $unlimited this param to decide if we get all newfeeds or just first 20
     * @param $offSet - the begining of the results by default seto to zero that is first row
     * @param $isPublished - if we want to get only published news feeds if we want to get all news feeds then set it to 0
     * @return doctrine object result of corresponding newfeeds or false in case of no data
     * @author Firas Bou karroum <firas.boukarroum@gmail.com>
     * */
    public function getNewsfeedsList($unlimited = false, $offSet = 0, $isPublished = 1)
    {
        $repo = $this->em->getRepository('AppBundle:Newsfeeds');
        $result = $repo->getNewsfeedsList($unlimited, $offSet, $isPublished);
        return $this->createJsonResponse($result);
    }
  /*
     * This method save news feeds data to database
     *
     * @param $newsfeedsObj
     *
     * @return id of the saved new feeds
     * @author Firas Bou Karroum <firas.boukarroum@gmail.com>
     */

    public function saveNewsfeedsData($newsfeedsObj)
    {
        if (!$newsfeedsObj) {
            $result = false;
            return $this->createJsonResponse($result);
        }

        $dbRepo = $this->em->getRepository('AppBundle:Newsfeeds')->saveNewsfeedsData($newsfeedsObj);

        $param['id'] = $dbRepo->getId();
        if (isset($param['id']) && !empty($param['id'])) {
            $result = $param['id'];
        } else {
            $result = false;
        }
        return $this->createJsonResponse($result);
    }   
   /*
     * This method updates an existing news feeds data to database
     *
     * @param $newsfeedsObj
     *
     * @return id of the saved new feeds
     * @author Firas Bou Karroum <firas.boukarroum@gmail.com>
     */
    public function updateNewsfeedsData($newsfeedsObj)
    {
        if (!$newsfeedsObj) {
            $result = false;
            return $this->createJsonResponse($result);
        }

        $dbRepo = $this->em->getRepository('AppBundle:Newsfeeds')->updateNewsfeedsData($newsfeedsObj);

        $param['id'] = $dbRepo->getId();
        if (isset($param['id']) && !empty($param['id'])) {
            $result = $param['id'];
        } else {
            $result = false;
        }
        return $this->createJsonResponse($result);
    }
}
<?php

namespace AppBundle\Repository\Newsfeeds;

use Doctrine\ORM\EntityRepository;
// here we include all our entites that we need to use in this repository <firas.boukarroum@gmail.com>
use AppBundle\Entity\Newsfeeds;

//use TTBundle\Entity\Webgeocities;

class NewsfeedsRepository extends EntityRepository
{
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
        $query     = $this->createQueryBuilder('dd')
            ->select('dd')
            ->where('dd.published = :isPublished')
            ->setParameter(':isPublished', $isPublished);


        // sets starting records to fetch
        if ($offSet > 0) {
            $query->setFirstResult($offSet);
        }

        $query->orderBy('dd.newsfeeds_date', 'DESC');

        if ($unlimited) {
            $query->groupBy('dd.id');
        } else {
            $query->groupBy('dd.id')->setMaxResults(20);
        }

        $quer   = $query->getQuery();
        $result = $quer->getScalarResult();

        if (!empty($result) && isset($result[0])) {
            return $result;
        } else {
            return false;
        }
    }
    
    /**
     *  This is the method is update Booking data. This is used in PackagesCorpoController.
     *
     */
    public function updateNewsfeedsData($newsfeedsObj)
    {
        $em        = $this->getEntityManager();
        $newsfeedsNewObject   = $em->getRepository('AppBundle:Newsfeeds')->findOneById($newsfeedsObj->getId());
        $updatedAt = new \DateTime("now");

        if ($newsfeedsObj->getNewsfeeds_title()) {
            $newsfeedsNewObject->setNewsfeeds_title($newsfeedsObj->getNewsfeeds_title());
        }
        if ($newsfeedsObj->getNewsfeeds_long_description()) {
            $newsfeedsNewObject->setNewsfeeds_long_description($newsfeedsObj->getNewsfeeds_long_description());
        }
        if ($newsfeedsObj->getNewsfeeds_short_description()) {
            $newsfeedsNewObject->setNewsfeeds_short_description($newsfeedsObj->getNewsfeeds_short_description());
        }
        if ($newsfeedsObj->getNewsfeeds_main_image()) {
            $newsfeedsNewObject->setNewsfeeds_main_image($newsfeedsObj->getNewsfeeds_main_image());
        }
        if ($newsfeedsObj->getNewsfeeds_thumb_image()) {
            $newsfeedsNewObject->setNewsfeeds_thumb_image($newsfeedsObj->getNewsfeeds_thumb_image());
        }
        if ($newsfeedsObj->getNewsfeeds_date()) {
            $newsfeedsNewObject->setNewsfeeds_date($newsfeedsObj->getNewsfeeds_date());
        }
        $newsfeedsNewObject->setUpdatedAt($updatedAt);

        $em->flush();
        return true;
    }
    /**
     * This method will save the data in booking table
     * @param $bookingDetailsObj
     * @return the object
     * */
    /*
     * @TODO continue the save method
     */
    public function saveNewsfeedsData($newsfeedObj)
    {
        $em          = $this->getEntityManager();
        $tableFields = $em->getClassMetadata('AppBundle:Newsfeeds')->getFieldNames();
//        $createdAt   = new \DateTime("now");

        $newsfeed = new Newsfeeds();

        $em->persist($newsfeed);
        $em->flush();
        return $newsfeed;
    }
}
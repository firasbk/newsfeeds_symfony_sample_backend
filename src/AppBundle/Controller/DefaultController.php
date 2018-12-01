<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Users;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class DefaultController extends Controller
{
    /**
     * @Route("", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $newsfeedsServices                 = $this->get('NewsfeedsServices');
        $results = $newsfeedsServices->getNewsfeedsList();
        $result = json_decode($results, true);
        
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'result' => $result['data'],
        ]);
    }
    /**
     *
     * @Route("/{slug}", name="feedsnews")
     */
    public function newFeedsDetailsAction($slug)
    {
        $newsfeedsServices                 = $this->get('NewsfeedsServices');
        $results = $newsfeedsServices->getNewsfeedsDetails($slug);
        $result = json_decode($results, true);
        
        // replace this example code with whatever you need
        return $this->render('default/news_feeds_details.twig', [
            'result' => $result['data'],
        ]);
    }
}

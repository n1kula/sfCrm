<?php 

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class AuthController
 */
class AuthController extends FOSRestController
{    
    /**
     * @ApiDoc(
     *  section="Auth",
     *  resource = true,
     *  description = "Auth user to API",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Error"
     *  }
     * )
     *
     * @return array
     */
    public function loginAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $username = $request->request->get('username', null);
        $password = $request->request->get('password', null);
        
        $qb = $em->createQueryBuilder();
        $qb
            ->select('u')
            ->from('AppBundle:User', 'u')
            ->where('u.username = :username')
            ->setParameter('username', $username);
        
        /** @var User $user */
        $user = $qb->getQuery()->getOneOrNullResult();
        
        if (!$user) {
            return new JsonResponse([
                'message' => 'Wrong credentials',
            ], 400);
        }
        
        $factory = $this->get('security.encoder_factory');
        $encoder = $factory->getEncoder($user);

        $valid = $encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt());
        
        if (!$valid) {
            return new JsonResponse([
                'message' => 'Wrong credentials',
            ], 400);
        }
        
        $apiKey = md5(microtime().rand());
        
        $user->setApiKey($apiKey);
        
        $em->persist($user);
        $em->flush();
        
        $result = [
            'apikey' => $apiKey,
        ];

        $view = $this->view($result, 200);

        return $this->handleView($view);
    }
}

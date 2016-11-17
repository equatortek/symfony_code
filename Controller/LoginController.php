<?php
namespace AppBundle\Controller;
use AppBundle\Entity\Login;
use AppBundle\Entity\userRegister;
use AppBundle\Entity\user;
use AppBundle\Entity\verification;
use AppBundle\Entity\ipTrack;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/MSP")
 *
 */

class LoginController extends Controller {
    /**
     * @Route("/")
     * @Template()
     */

    public function LoginAction()
    {
        return $this->render('login.html.twig');
    }
    /**
     * @Route("/loginAuthenticate")
     * @Template()
     */
    public function loginAuthenticateAction()
    {
        $loginData = json_decode($_POST['data']);
        $passwordSalt = 'msp';
        $loginStatus = '';
        $securePassword = md5($passwordSalt.$loginData->loginPassword);

        $dbConnection = $this->getDbConnection();

        $query = $dbConnection->createQuery('select u from AppBundle:user u where u.userName = :username')->setParameter('username',$loginData->loginName);
        $users = $query->getOneOrNullResult();
        if($users != '')
        {
            if($users->getIsAdmin()==1)
            {
                $loginStatus = "Invalid user name";
            }
            else
            {
                if($loginData->loginName==$users->getUserName() && $securePassword == $users->getPassword())
                {
                    if($users->getIsActive() == 1)
                    {
                        $users->setLastLogin(new \DateTime());
                        $dbConnection->flush();
                        $this->setUserCookie($users->getUserName(),$users->getUserId(),$users->getIsAdmin());
                        // $userType=$users->getIsAdmin();

                        $loginStatus = "success";

                    }
                    else
                    {
                        $loginStatus = "account not verified";
                    }

                }
                else
                {
                    $loginStatus = "credential mismatch";
                }

            }

        }
        else
        {
            $loginStatus = "Invalid user name";
        }

        return new Response(json_encode($loginStatus));
    }

    /**
     * @Route("/userRegister")
     * @Template()
     */
    public function userRegisterAction()
    {
        $userRegisterData=json_decode($_POST['data']);
        $pwdSalt = 'msp';
        $status = '';

        try
        {
            $user = new user();
            $existingUserId = $this->getUserId($userRegisterData->userName);
            if($existingUserId == 0)
            {
                $dbConnection = $this->getDbConnection();
                $securePwd = md5($pwdSalt.$userRegisterData->userPassword);

                $user->setUserName($userRegisterData->userName);
                $user->setPassword($securePwd);
                $user->setIsActive(0);
                $user->setIsDeleted(0);
                $user->setIsLocked(0);
                $user->setCreatedDate(new \DateTime());

                $dbConnection->persist($user);
                $dbConnection->flush();

                $verificationString = $this->generateRandomString();
                if($verificationString != '')
                {
                    $host = $_SERVER['HTTP_HOST'];
                    $persistStatus = $this->persistVerificationCode($user->getUserId(),$verificationString,1);
                    if($persistStatus === 'code persisted')
                    {
                        $body = "<html>
                                    <head>
                                      <title>Account Verification</title>
                                    </head>
                                    <body>
                                        <b>To Activate your account very first time you must need to  verify your account with the following link</b><br>
                                        <a href='$host/audiomixdemo/MSP#/Accountverification'>click here to verify your account</a><br>
                                        Your Account Verification code is: $verificationString
                                    </body>
                                </html>";
                        $this->sendConfirmationMail($userRegisterData->userName,$body);
                        $status="User Created";
                    }
                }
            }
            else
            {
                $status = "User Exist";
            }
            return new Response(json_encode($status));
        }
        catch (Exception $ex)
        {
            return new Response(json_encode($ex));
        }

    }
}
<?php

namespace App\Controller;

use App\Repository\BlackListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Ldap\Ldap;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use function PHPUnit\Framework\isEmpty;

class ContactsController extends AbstractController
{
    #[Route('/contacts', name: 'contacts')]
    public function index(Request $request, Ldap $ldap, SerializerInterface $serializer,BlackListRepository $blackListRepository): Response
    {

        //param ldap
        $dn = "cn=adLecture,ou=Users,dc=DOMAIN,dc=com";
        $password = "adLecture";

        //conn ldap
        $ldap->bind($dn, $password);

        //param get
        $nom = $request->query->get('nom');
        $prenom = $request->query->get('prenom');
        $pole = $request->query->get('pole');
        $uf = $request->query->get('uf');
        $num = $request->query->get('numero');
        $type = $request->query->get('type');
//dd($uf);


        //recherche
        $query = '(&(objectclass=contactRecord)';

        $queryContactRecord = $ldap->query(
            'ou=contact, ou=PERRENS,o=AASTRA,dc=DOMAIN,dc=com',
            $query . ')');
//        $query3 = $ldap->query('ou=people, ou=PERRENS,o=AASTRA,dc=DOMAIN,dc=com', '(&(objectclass=*)(cleUid=' . $test . '))');

        $results = $queryContactRecord->execute()->toArray();

        $res = "";
        foreach ($results as $entry) {

            $res = $res . json_encode($entry->getAttributes()) . ", ";

        }

        return $this->render('contacts/index.html.twig', [
            'data' => $res,
        ]);


    }

}

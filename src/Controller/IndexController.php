<?php

namespace App\Controller;

use App\Repository\BlackListRepository;
use App\Repository\InfoCompRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Ldap\Ldap;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(Request $request, Ldap $ldap, BlackListRepository $blackListRepository, InfoCompRepository $infoCompRepository): Response
    {

        $dn = 'cn=adLecture,ou=Users,dc=DOMAIN,dc=com';
        $password = 'adLecture';
        $ldap->bind($dn, $password);

        $nom = $request->query->get('nom');
        $prenom = $request->query->get('prenom');
        $pole = $request->query->get('pole');
        $uf = $request->query->get('uf');
        $num = $request->query->get('numero');
        $type = $request->query->get('type');
        $infocomp = $request->query->get('infocomp');

        $query = '(&(objectclass=peopleRecord)(displayName=*' . (!empty($nom) ? $nom . '*' : '') . ')(displayGn=*' . (!empty($prenom) ? $prenom . '*' : '') . ')';
        $query .= '(hierarchySV=*' . (!empty($pole) ? $pole . '*)' : ')');
        $query .= '(hierarchySV=*' . (!empty($uf) ? $uf . '*)' : ')');
        $query .= '(mainLineNumber=*' . (!empty($num) ? $num . '*' : '') . ')';

        if (!empty($infocomp)) {
            $info = $infoCompRepository->findAll();
            $query .= '(|';

            foreach ($info as $item)
                if (str_contains($item->getChampComp(), $infocomp))
                    $query .= '(mainLineNumber=*' . (!empty($item->getMainLineNumber()) ? $item->getMainLineNumber() . '*' : '') . ')';

            $query .= ')';
        }

        $queryPeopleRecord = $ldap->query(
            'ou=people, ou=PERRENS,o=AASTRA,dc=DOMAIN,dc=com',
            $query . ')');

        $results = $queryPeopleRecord->execute()->toArray();

        $res = "";

        foreach ($results as $entry) {
            if (!$blackListRepository->findBy(['displayName' => implode($entry->getAttribute("displayName"))])) {
                if (!str_contains(json_encode($entry->getAttributes()), "ABO"))
                    if (empty($type) && implode($entry->getAttribute("displayGn")) !== " ")
                        $res = $res . json_encode($entry->getAttributes()) . ", ";
                if ($type === 'autre' && implode($entry->getAttribute("displayGn")) === " ")
                    $res = $res . json_encode($entry->getAttributes()) . ", ";
            }
        }

        return $this->render('index/index.html.twig', [
            'data' => $res,
        ]);
    }
}

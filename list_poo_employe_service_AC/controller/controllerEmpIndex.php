<?php 
session_start();
include_once('../model/EmpService.php');
include_once('../presentation/empIndex.php');
include_once('../presentation/utilIndex.php'); 

/************************************** Ajouter */
if (isset($_GET["action"]) && (isset($_SESSION['username'])) )
{   
    if($_GET["action"]=="afficheEmp") 
    {
        /************************************** Tout les services */
        $tabResearch = Empservice::research(); 

        /************************************** ne peux pas sup service */
        $tabSupOne = Empservice::supOne(); 

        /************************************** Profil */
        $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'administrateur';

        html();
        empIndex($admin, $tabResearch, $tabSupOne);
    }
    elseif($_GET["action"]=="add")
    {    
        html();
        EmpFormAjout();
    }
        if ($_GET["action"]=="ajouterOK")
        {
            $embauche = empty($_POST['embauche']) ? NULL : $_POST['embauche'];
            $dateEmbauche = new DateTime($embauche);
            $employe = new Employe;
            $employe->setNo_emp(empty($_POST['no_emp']) ? NULL : $_POST['no_emp'])
                    ->setNom(empty($_POST['nom']) ? NULL : $_POST['nom'])
                    ->setPrenom(empty($_POST['prenom']) ? NULL : $_POST['prenom'])
                    ->setEmploi(empty($_POST['emploi']) ? NULL : $_POST['emploi'])
                    ->setEmbauche($dateEmbauche)
                    ->setSal(empty($_POST['sal']) ? NULL : $_POST['sal'])
                    ->setComm(empty($_POST['comm']) ? NULL : $_POST['comm'])
                    ->setNoserv(empty($_POST['noserv']) ? NULL : $_POST['noserv'])
                    ->setSup(empty($_POST['sup']) ? NULL : $_POST['sup'])
                    ->setNoproj(empty($_POST['noproj']) ? NULL : $_POST['noproj']);
        
                 
            EmpService::add($employe);
            
            /************************************** Tout les services */
            $tabResearch = Empservice::research(); 

            /************************************** ne peux pas sup service */
            $tabSupOne = Empservice::supOne(); 

            /************************************** Profil */
            $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'administrateur';

            html();
            empIndex($admin, $tabResearch, $tabSupOne);
        } 
    /************************************** Modifier */
    if($_GET["action"]=="modif" && isset($_GET['no_emp']) ) 
    {
        $embauche = empty($_POST['embauche']) ? NULL : $_POST['embauche'];
        $dateEmbauche = new DateTime($embauche);
        $employe = new Employe;
        $employe->setNo_emp(empty($_GET['no_emp']) ? NULL : $_GET['no_emp'])
                ->setNom(empty($_POST['nom']) ? NULL : $_POST['nom'])
                ->setPrenom(empty($_POST['prenom']) ? NULL : $_POST['prenom'])
                ->setEmploi(empty($_POST['emploi']) ? NULL : $_POST['emploi'])
                ->setEmbauche($dateEmbauche)
                ->setSal(empty($_POST['sal']) ? NULL : $_POST['sal'])
                ->setComm(empty($_POST['comm']) ? NULL : $_POST['comm'])
                ->setNoserv(empty($_POST['noserv']) ? NULL : $_POST['noserv'])
                ->setSup(empty($_POST['sup']) ? NULL : $_POST['sup'])
                ->setNoproj(empty($_POST['noproj']) ? NULL : $_POST['noproj']);

        $objectResearch = EmpService::researchOneById($employe);   
var_dump($objectResearch);
        html();
        empFormModif($objectResearch);
        }
        if($_GET["action"]=="modifierOK") 
        {        
            $embauche = empty($_POST['embauche']) ? NULL : $_POST['embauche'];
            $dateEmbauche = new DateTime($embauche);
            $employe = new Employe;
            $employe->setNo_emp($_POST['no_emp'])
                    ->setNom(empty($_POST['nom']) ? NULL : $_POST['nom'])
                    ->setPrenom(empty($_POST['prenom']) ? NULL : $_POST['prenom'])
                    ->setEmploi(empty($_POST['emploi']) ? NULL : $_POST['emploi'])
                    ->setEmbauche($dateEmbauche)
                    ->setSal(empty($_POST['sal']) ? NULL : $_POST['sal'])
                    ->setComm(empty($_POST['comm']) ? NULL : $_POST['comm'])
                    ->setNoserv(empty($_POST['noserv']) ? NULL : $_POST['noserv'])
                    ->setSup(empty($_POST['sup']) ? NULL : $_POST['sup'])
                    ->setNoproj(empty($_POST['noproj']) ? NULL : $_POST['noproj']);

            EmpService::modifier($employe); 

            /************************************** Tout les services */
            $tabResearch = Empservice::research(); 
            /************************************** ne peux pas sup service */
            $tabSupOne = Empservice::supOne(); 
            /************************************** Profil */
            $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'administrateur';
            html();
            empIndex($admin, $tabResearch, $tabSupOne); 
    }
    /************************************** Supprimer */
    elseif ($_GET['action']=="delete" && isset($_GET['no_emp']))
    {  
        $employe = new Employe;
        $employe->setNo_emp($_GET['no_emp']);

        EmpService::supprimer($employe); 
        /************************************** Tout les services */
        $tabResearch = Empservice::research(); 

        /************************************** ne peux pas sup service */
        $tabSupOne = Empservice::supOne(); 

        /************************************** Profil */
        $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'administrateur';
        html();
        empIndex($admin, $tabResearch, $tabSupOne); 
    }
    elseif($_GET['action']== "voir" && isset($_GET['no_emp']) )   
    {   
        /************************************** Profil */
        $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'administrateur';

        $employe = new Employe;
        $employe->setNo_emp($_GET['no_emp']);
        $objectResearch = Empservice::researchOneById($employe); 
        html(); 
        empDetail($admin, $objectResearch);
    }
}

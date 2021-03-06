<?php 
session_start (); 
include_once('../model/ServService.php');
include_once('../presentation/servIndex.php');
include_once('../presentation/utilIndex.php'); 
include_once('../model/ServiceException.php');


echo "Bonjour " . ($_SESSION['username']);
/************************************** Ajouter */
if (isset($_GET['action']) && (isset($_SESSION['username'])))
{ 
    if($_GET["action"]=="afficheServ") 
    {
        try {
        /************************************** Tout les services */
        $tabResearch = ServService::research(); 

        /************************************** ne peux pas sup service */
        $dataSOS = ServService::supOne(); 

        /************************************** Profil */
        $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'administrateur';
        html();
        servIndex($admin, $tabResearch, $dataSOS);
        }
        catch (ServiceException $se) {
        /************************************** Tout les services */
        $tabResearch = ServService::research(); 

        /************************************** ne peux pas sup service */
        $dataSOS = ServService::supOne(); 

        /************************************** Profil */
        $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'administrateur';
        html();
        servIndex($admin, $tabResearch, $dataSOS,23001);
        } 
    }  
    elseif($_GET['action']=="add")
    {
        try {
            html();
            servFormAjout();
        } 
        catch (ServiceException $se) {
            html();
            servFormAjout(23007);
        } 
    }
        if ($_GET["action"]=="ajouterOK")
        {
            try {
                $service = new Service;
                $service->setNoserv(empty(htmlentities($_POST['noserv'])) ? NULL : htmlentities($_POST['noserv']))
                        ->setService(empty(htmlentities($_POST['service'])) ? NULL : htmlentities($_POST['service']))
                        ->setVille(empty(htmlentities($_POST['ville'])) ? NULL : htmlentities($_POST['ville']));
                    
                ServService::add($service); 
                /************************************** Tout les services */
                $tabResearch = ServService::research(); 
    
                /************************************** ne peux pas sup service */
                $dataSOS = ServService::supOne(); 
        
                /************************************** Profil */
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'administrateur';
                html();
                servIndex($admin, $tabResearch, $dataSOS,24000);
            }
            catch (ServiceException $se) {
                html();
                servFormAjout($se->getCode(), $se->getMessage());
                }
        } 
    /************************************** Modifier */
    if ($_GET['action']=="modif" && isset($_GET['noserv']))
    { 
        try {
            $service = new Service;
            $service->setNoserv(htmlentities($_GET['noserv'])) 
                    ->setService(empty(htmlentities($_POST['service'])) ? NULL : htmlentities($_POST['service']))
                    ->setVille(empty(htmlentities($_POST['ville'])) ? NULL : htmlentities($_POST['ville']));

            $objectResearch = ServService::researchOneById($service);
            ServService::modifier($service);
            html();
            servFormModif($objectResearch);
        }
        catch (ServiceException $se) {
            $service = new Service;
            $service->setNoserv(htmlentities($_GET['noserv'])) 
                    ->setService(empty(htmlentities($_POST['service'])) ? NULL : htmlentities($_POST['service']))
                    ->setVille(empty(htmlentities($_POST['ville'])) ? NULL : htmlentities($_POST['ville']));

            $objectResearch = ServService::researchOneById($service);
            ServService::modifier($service);
            html();
            servFormModif($objectResearch,23008);
        } 
    }
       if($_GET["action"]=="modifierOK") 
        {    
            try {
                $service = new Service;
                $service->setNoserv(htmlentities($_POST['noserv']))
                ->setService(empty(htmlentities($_POST['service'])) ? NULL : htmlentities($_POST['service']))
                    ->setVille(empty(htmlentities($_POST['ville'])) ? NULL : htmlentities($_POST['ville']));

                ServService::modifier($service);
                /************************************** Tout les services */
                $tabResearch = ServService::research(); 
    
                /************************************** ne peux pas sup service */
                $dataSOS = ServService::supOne(); 
        
                /************************************** Profil */
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'administrateur';
                html();
                servIndex($admin, $tabResearch, $dataSOS,24001);
            }
            catch (ServiceException $se) {
                /************************************** Tout les services */
                $tabResearch = ServService::research(); 
        
                /************************************** ne peux pas sup service */
                $dataSOS = ServService::supOne(); 
        
                /************************************** Profil */
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'administrateur';
                html();
                servIndex($admin, $tabResearch, $dataSOS,23004);
                }
    }
    /************************************** Supprimer */
    elseif ($_GET['action']=="delete" )
    {  
        try {
            $service = new Service;
            $service->setNoserv(htmlentities($_GET['noserv']));
        
            servService::supprimer($service);
            /************************************** Tout les services */
            $tabResearch = ServService::research(); 
    
            /************************************** ne peux pas sup service */
            $dataSOS = ServService::supOne(); 
    
            /************************************** Profil */
            $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'administrateur';
            html();
            servIndex($admin, $tabResearch, $dataSOS, 24002);
        }
        catch (ServiceException $se) {
            /************************************** Tout les services */
            $tabResearch = ServService::research(); 
    
            /************************************** ne peux pas sup service */
            $dataSOS = ServService::supOne(); 
    
            /************************************** Profil */
            $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'administrateur';
            html();
            servIndex($admin, $tabResearch, $dataSOS,23005);
            }

    }
    elseif($_GET['action']== "voir" && isset($_GET['noserv']) )   
    {   
        try {
            $service = new Service;
            $service->setNoserv(htmlentities($_GET['noserv']));
            $objectResearch = Servservice::researchOneById($service); 
            html(); 
            servDetail($objectResearch);
        } 
        catch (ServiceException $se) {
            $service = new Service;
            $service->setNoserv(htmlentities($_GET['noserv']));
            $objectResearch = Servservice::researchOneById($service); 
            html(); 
            servDetail($objectResearch,23006);        
        } 
    }
}


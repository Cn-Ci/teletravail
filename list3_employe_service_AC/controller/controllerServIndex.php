<?php 
// A faire : LOGIN, n'ajoute pas un nouvel employe, ne recupere pas et ne modifie pas

session_start (); 
include_once('../model/ServService.php');
include_once('../presentation/servIndex.php');
include_once('../presentation/utilIndex.php'); 


echo "Bonjour " . ($_SESSION['username']);
/************************************** Ajouter */
if (isset($_GET['action']) && (isset($_SESSION['username'])))
{ 
    if($_GET["action"]=="afficheServ") 
    {
        /************************************** Tout les services */
        $dataR = ServService::research(); 

        /************************************** ne peux pas sup service */
        $dataSOS = ServService::supOne(); 

        /************************************** Profil */
        $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'administrateur';
        html();
        servIndex($admin, $dataR, $dataSOS);
    }  
    elseif($_GET['action']=="add")
    {
        html();
        servFormAjout();
    }
        if ($_GET["action"]=="ajouterOK")
        {
            $service = new Service;
            $service->setNoserv(empty($_POST['noserv']) ? NULL : $_POST['noserv'])
                    ->setService(empty($_POST['service']) ? NULL : $_POST['service'])
                    ->setVille(empty($_POST['ville']) ? NULL : $_POST['ville']);
                
            ServService::add($service); 
            /************************************** Tout les services */
            $dataR = ServService::research(); 

            /************************************** ne peux pas sup service */
            $dataSOS = ServService::supOne(); 

            /************************************** Profil */
            $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'administrateur';
            html();
            servIndex($admin, $dataR, $dataSOS);
        } 
    /************************************** Modifier */
    if ($_GET['action']=="modif" && isset($_GET['noserv']))
    { 
        $service = new Service;
        $service->setNoserv($_GET['noserv']) 
                ->setService(empty($_POST['service']) ? NULL : $_POST['service'])
                ->setVille(empty($_POST['ville']) ? NULL : $_POST['ville']);

        $dataV = ServService::researchOneByNoserv($service);
        ServService::modifier($service);
        html();
        servFormModif($dataV);
    }
       if($_GET["action"]=="modifierOK") 
        {    
            $service = new Service;
            $service->setNoserv($_POST['noserv'])
            ->setService(empty($_POST['service']) ? NULL : $_POST['service'])
                ->setVille(empty($_POST['ville']) ? NULL : $_POST['ville']);

            ServService::modifier($service);
           
            /************************************** Tout les services */
            $dataR = servService::research(); 

            /************************************** ne peux pas sup service */
            $dataSOS = servService::supOne(); 

            /************************************** Profil */
            $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'administrateur';
            html();
            servIndex($admin, $dataR, $dataSOS);
    }
    /************************************** Supprimer */
    elseif ($_GET['action']=="delete" )
    {  
        $service = new Service;
        $service->setNoserv($_GET['noserv']);
    
        servService::supprimer($service);
        /************************************** Tout les services */
        $dataR = servService::research(); 

        /************************************** ne peux pas sup service */
        $dataSOS = servService::supOne(); 

        /************************************** Profil */
        $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'administrateur';
        html();
        servIndex($admin, $dataR, $dataSOS);
    }
    elseif($_GET['action']== "voir" && isset($_GET['noserv']) )   
    {   
        $service = new Service;
        $service->setNoserv($_GET['noserv']);
        $dataV = Servservice::researchOneByNoserv($service); 
        html(); 
        servDetail($dataV);
    }
}
else
{
    echo "pas connecté";
}

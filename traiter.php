<?php 
/**
 * BASE_URL:/backend/auth.php?service=
 * donner aux clients tous les services: auth, register,...
 * services
 * * auth(login, pass) return (status,code,id, prenom, nom, login) du user
 * * * Pour l'authentification des users
 * * * Methode: POST
 * * register(nom, prenom, login, pass) return code
 * * * pour une creation de compte
 * * * Methode: POST
 * * * code=
 * * * * 0 action reussi avec succ�s
 * * * * 1 probl�me d'acc�s � la base
 */
include_once(dirname(__FILE__)."/f_db.php");
header('Content-Type: application/json');
$service=$_REQUEST['service']; 
 
switch ($service) 
{
    case 'loger':
        ///backend/auth.php?service=auth
        //login=diouf&pass=essa123
        //1-recup�ration des infos
        $email=$_REQUEST['email'];
        $password=$_REQUEST['password'];
        $password=SHA1($password);
        $role=$_REQUEST['role'];

        //2-Lancement des requetes dans la base
        $requete="SELECT * FROM users WHERE email='".$email."' AND password ='".$password."' AND role ='".$role."'" ;
        $resultat=$connexion->query($requete);
        $reponse =array("id_user"=>0,"email"=>"","password"=>"","role"=>"","code"=>1,"status"=>"faild");
        //3- parcours des resultats de la requetes
        if($resultat)
        {
            foreach($resultat as $row)
             {
                $reponse["id_user"]=$row['id_user'];
                $reponse["email"]=$row['email'];
                $reponse["password"]=$row['password'];
                $reponse["role"]=$row['role'];
                $reponse["code"]="0";
                $reponse["status"]="success";
               //creation de la session pour ne plus lui demander de s'authentifier
               $_SESSION['users']= $reponse;
            }
        }
        //4-Reponse jsonis� au client.
        echo(json_encode($reponse));
        break;

        /*case 'ins_admin':
        //1-insrtion d'un user_admin
        $nom_useradmin=$_REQUEST['nom'];
        $prenom_useradmin=$_REQUEST['prenom'];

        $date_naissance=$_REQUEST['date_naissance'];
        $email=$_REQUEST['email'];
        $password=$_REQUEST['pass'];
        $password=SHA1($password);
        $telephone=$_REQUEST['tel'];
        $cin=$_REQUEST['carte'];
        $adresse=$_REQUEST['adresse'];
        $ville=$_REQUEST['ville'];
        $sexe=$_REQUEST['genre'];
        $role=$_REQUEST['role'];

        $requete1="INSERT INTO `user_admins`(`id_user_admin`, `nom_user_admin`, `prenom_user_admin`) VALUES (0,'$nom_useradmin','$prenom_useradmin')";
        $resultat=$connexion->query($requete1);

        $requete="SELECT * FROM `user_admins` WHERE `nom_user_admin`='".$nom_useradmin."' AND `prenom_user_admin`='".$prenom_useradmin."'";
        $resultat1=$connexion->query($requete);
        $id_gerant0=0;
        if($resultat1)
        {
            foreach($resultat1 as $row)
             {
                $id_gerant0=$row['id_user_admin'];
            }
        }
        
       $requete2="INSERT INTO `users`(`id_user`, `date_naissance`, `email`, `password`, `telephone`, `cin`, `adresse`, `ville`, `sexe`, `role`, `id_role`) VALUES (0,'$date_naissance','$email','$password','$telephone','$cin','$adresse','$ville','$sexe','$role','$id_gerant0')";
        $resultat=$connexion->query($requete2);
        $reponse =array("code"=>1);
        if($resultat) $reponse["code"]=0;
        //3- parcours des resultats de la requetes
        
        //4-Reponse jsonis� au client.
        echo(json_encode($reponse));
        break;*/
        //insertion de gerant
        case 'ins_gerant':
        //1-insrtion d'un user_admin
        $nom_gerant=$_REQUEST['nom_gerant'];
        $prenom_gerant=$_REQUEST['prenom_gerant'];

        $date_naissance=$_REQUEST['date_naissance'];
        $email=$_REQUEST['email'];
        $password=$_REQUEST['password'];
        $password=SHA1($password);
        $telephone=$_REQUEST['telephone'];
        $cin=$_REQUEST['cin'];
        $adresse=$_REQUEST['adresse'];
        $ville=$_REQUEST['ville'];
        $sexe=$_REQUEST['sexe'];
        $role=$_REQUEST['role'];

        $requete1="INSERT INTO `gerants`(`id_gerant`, `nom_gerant`, `prenom_gerant`) VALUES (0,'$nom_gerant','$prenom_gerant')";
        $resultat=$connexion->query($requete1);

        $requete="SELECT * FROM `gerants` WHERE `nom_gerant`='".$nom_gerant."' AND `prenom_gerant`='".$prenom_gerant."'";
        $resultat1=$connexion->query($requete);
        $id_gerant0=0;
        if($resultat1)
        {
            foreach($resultat1 as $row)
             {
                $id_gerant0=$row['id_gerant'];
            }
        }
        
        $requete2="INSERT INTO `users`(`id_user`, `date_naissance`, `email`, `password`, `telephone`, `cin`, `adresse`, `ville`, `sexe`, `role`, `id_role`) VALUES (0,'$date_naissance','$email','$password','$telephone','$cin','$adresse','$ville','$sexe','$role','$id_gerant0')";
        $resultat=$connexion->query($requete2);
        $reponse =array("code"=>1);
        if($resultat) $reponse["code"]=0; 
        echo(json_encode($reponse));
        break;

        //insertion abonnee 
        case 'ins_abonne':
        // insertion de abonne
        $nom_abonne=$_REQUEST['nom_abonne'];
        $prenom_abonne=$_REQUEST['prenom_abonne'];

        $date_naissance=$_REQUEST['date_naissance'];
        $email=$_REQUEST['email'];
        $password=$_REQUEST['password'];
        //$password=SHA1($password);
        $telephone=$_REQUEST['telephone'];
        $cin=$_REQUEST['cin'];
        $adresse=$_REQUEST['adresse'];
        $ville=$_REQUEST['ville'];
        $sexe=$_REQUEST['sexe'];
        $role=$_REQUEST['role'];


        $date_d=$_REQUEST['date_debut'];
        $dure=$_REQUEST['duree'];
        $local=$_REQUEST['localite'];
        $car=$_REQUEST['voiture'];
        $matrix=$_REQUEST['matricule'];



        //insertion abonnee
        $requete1="INSERT INTO `abonnes`(`id_abonne`, `nom_abonne`, `prenom_abonne`) VALUES (0,'$nom_abonne','$prenom_abonne')";
        $resultat=$connexion->query($requete1);

        $requete="SELECT * FROM `abonnes` WHERE `nom_abonne`='".$nom_abonne."' AND `prenom_abonne`='".$prenom_abonne."'";
        $resultat1=$connexion->query($requete);
        $id_gerant0=0;
        if($resultat1)
        {
            foreach($resultat1 as $row)
             {
                $id_gerant0=$row['id_abonne'];
            }
        }
        
        
        $requete2="INSERT INTO `users`(`id_user`, `date_naissance`, `email`, `password`, `telephone`, `cin`, `adresse`, `ville`, `sexe`, `role`, `id_role`) VALUES (0,'$date_naissance','$email','$password','$telephone','$cin','$adresse','$ville','$sexe','$role','$id_gerant0')";
        $resultat=$connexion->query($requete2);

        // recherche l'id de users
        $requetea="SELECT * FROM `users` WHERE `email`='".$email."' AND `telephone`='".$telephone."' AND `role`='".$role."'";
        $resultat2=$connexion->query($requetea);
        $id_gerant1=0;
        if($resultat1)
        {
            foreach($resultat2 as $row)
             {
                $id_gerant1=$row['id_user'];
            }
        }

        //insertion reservation

        $requete3="INSERT INTO `reservations`(`id_reservation`,`date_debut`, `duree`, `localite`, `voiture`, `matricule`,`id_user_r`) VALUES (0,'$date_d','$dure','$local','$car','$matrix','$id_gerant1')";
        $resultat=$connexion->query($requete3);
        var_dump($requete3);
        $reponse =array("code"=>1);

        if($resultat) $reponse["code"]=0;
        //3- parcours des resultats de la requetes
        
        //4-Reponse jsonis� au client.
        echo(json_encode($reponse));
        break;
        // pour reservation

        case 'ins_reservation':

        

        /*$nom_abonne=$_REQUEST['nom_abonne'];
        $prenom_abonne=$_REQUEST['prenom_abonne'];
        $date_naissance=$_REQUEST['date_naissance'];
        $telephone=$_REQUEST['telephone'];

        
        $date_d=$_REQUEST['date_debut'];
        $dure=$_REQUEST['duree'];
        $local=$_REQUEST['localite'];
        $car=$_REQUEST['voiture'];
        $matrix=$_REQUEST['matricule'];
      

        //$requete="SELECT * FROM `abonnes` WHERE `nom_abonne`='".$nom_abonne."' AND `prenom_abonne`='".$prenom_abonne."'";

        $requete="SELECT * FROM `abonnes`,`users`,`reservations` WHERE `nom_abonne`='".$nom_abonne."' AND `prenom_abonne`='".$prenom_abonne."' AND `date_naissance`='".$date_naissance."' AND `telephone`='".$telephone."' AND `id_abonne`=`id_role` AND `id_user`=`id_user_r`";
        
        $resultat1=$connexion->query($requete);
        $id_gerant0=0;
        if($resultat1)
        {
            foreach($resultat1 as $row)
             {
                $id_gerant0=$row['id_user'];
            }
        }
        
        //insertion reservation

        $requete3="INSERT INTO `reservations`(`id_reservation`,`date_debut`, `duree`, `localite`, `voiture`, `matricule`,`id_user_r`) VALUES (0,'$date_d','$dure','$local','$car','$matrix','$id_gerant1')";
       
        $resultat=$connexion->query($requete3);*/
        $reponse =array("code"=>1);
        if($resultat) $reponse["code"]=0;
        //3- parcours des resultats de la requetes
        
        //4-Reponse jsonis� au client.
        echo(json_encode($reponse));
        break;

        case 'admin_search':

        $subt=$_REQUEST['srch_r'];
        $srole="abonne";
        $spassword="neant";

        if (isset($submit)) 
        {
            $requete="SELECT * FROM `abonnes`,`users`,`reservations` WHERE `nom_abonne` LIKE '%".$subt."%' AND`role`='".$srole."' AND `id_role`=`id_abonne` AND `id_user`=`id_user_r` AND `password`='".$spassword."'";

           
            $resultat=$connexion->query($requete);
           
             $reponse =array("id_abonne"=>0,"nom_abonne"=>"","prenom_abonne"=>"","date_naissance"=>"","telephone"=>"","voiture"=>"","matricule"=>"","code"=>1,"status"=>"faild");
       
           if ($resultat) 
           {
                foreach($resultat as $row)
            {
                $reponse["id_abonne"]=$row['id_abonne'];
                $reponse["nom_abonne"]=$row['nom_abonne'];
                $reponse["prenom_abonne"]=$row['prenom_abonne'];
                $reponse["date_naissance"]=$row['date_naissance'];
                $reponse["telephone"]=$row['telephone'];
                $reponse["voiture"]=$row['voiture'];
                $reponse["matricule"]=$row['matricule'];
                $reponse["code"]="0";
                $reponse["status"]="success";
                //$_SESSION["abonnes"]= $reponse;
            }
           }
           
        }
       

        
        //4-Reponse jsonis� au client.
        echo(json_encode($reponse));
        break;

        default:
        echo "service inconnu";
        break;
}



?>

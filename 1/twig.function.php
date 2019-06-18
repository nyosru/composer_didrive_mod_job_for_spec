<?php

/**
  определение функций для TWIG
 */

// есть ли открытая и не закрытая смена по человеку
$function = new Twig_SimpleFunction('where_now_job_people', function ( $db, int $user, $folder = '', $mod_shecks = '050.chekin_checkout' ) {

    if (empty($folder)) {
        $folder = \Nyos\Nyos::$folder_now;
    }

    require $_SERVER['DOCUMENT_ROOT'].'/sites/'.$folder.'/config.func.php';
    $r = get_no_fin_sp($db, $folder, $user, $mod_shecks);    

    return $r;

    //\f\pa(\Nyos\nyos::$menu,2);
    // $e = \Nyos\mod\items::getItems( $db, \Nyos\nyos::$folder_now, $module, $stat, null );
    // return $e;
    //return \Nyos\Nyos::creatSecret($text);
});
$twig->addFunction($function);

/**
 * что за спец за этой соц сетью
 */
$function = new Twig_SimpleFunction('whois_spec_this_socweb', function ( $db, int $user, $folder = '', $mod_user_link = '2.links_socweb_people' ) {

    if (empty($folder)) {
        $folder = \Nyos\Nyos::$folder_now;
    }

    $s = $db->prepare('SELECT 
            
            mid3.value jobman

        FROM 
            `gm_user` user

        INNER JOIN `mitems-dops` mid ON mid.name = \'user_id\' AND mid.value = :user
        INNER JOIN `mitems-dops` mid2 ON mid2.name = \'jobman\' AND mid2.id_item = mid.id_item 
        INNER JOIN `mitems` mi ON mi.folder = :folder AND mi.module = :mod_user_link AND mid.id_item = mi.id
        INNER JOIN `mitems-dops` mid3 ON mid3.name = \'jobman\' AND mid3.id_item = mid.id_item 
        
        WHERE
            user.folder = :folder

        ');

    $s->execute(array(
        ':folder' => $folder,
        ':user' => $user,
        ':mod_user_link' => $mod_user_link
    ));

    if ($r = $s->fetch()) {
        // \f\pa($r);
        return $r['jobman'];
    } else {
        return false;
    }

    //\f\pa(\Nyos\nyos::$menu,2);
    // $e = \Nyos\mod\items::getItems( $db, \Nyos\nyos::$folder_now, $module, $stat, null );
    // return $e;
    //return \Nyos\Nyos::creatSecret($text);
});
$twig->addFunction($function);


$function = new Twig_SimpleFunction('where_now_job_people2', function ( $db, int $user, $folder = '', $mod_user_link = '2.links_socweb_people', $mod_shecks = '050.chekin_checkout' ) {

    if (empty($folder)) {
        $folder = \Nyos\Nyos::$folder_now;
    }

    $s = $db->prepare('SELECT * 
        FROM 
            `gm_user` user
            
        INNER JOIN `mitems-dop` mid ON mid.name = \'user_id\' AND mid.value = :user
        INNER JOIN `mitems-dop` mid2 ON mid2.name = \'jobman\' AND mid2.id_item = mid.id_item 
        INNER JOIN `mitems` mi ON mi.folder = :folder AND mi.module = :mod_user_link
        
        WHERE 
            user.folder = :folder 
        ');

    $s->execute(array(
        ':folder' => $folder,
        ':user' => $user,
        ':mod_user_link' => $mod_user_link
    ));

    $r = $s->fetchAll();
    // \f\pa($r);

    return $r;

    //\f\pa(\Nyos\nyos::$menu,2);
    // $e = \Nyos\mod\items::getItems( $db, \Nyos\nyos::$folder_now, $module, $stat, null );
    // return $e;
    //return \Nyos\Nyos::creatSecret($text);
});
$twig->addFunction($function);


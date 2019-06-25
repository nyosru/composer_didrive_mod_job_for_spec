<?php

/**
  определение функций для TWIG
 */
// есть ли открытая и не закрытая смена по человеку
$function = new Twig_SimpleFunction('where_now_job_user', function ( $db, int $user_enter, $folder = '', $mod_shecks = '050.chekin_checkout', $mod_user_link_soc = '2.links_socweb_people' ) {

    if (empty($folder)) {
        $folder = \Nyos\Nyos::$folder_now;
    }

    $r = \Nyos\mod\job_for_spec::whereNowJobmanUser($db, $user_enter, $folder);
    return $r;

});
$twig->addFunction($function);





// что ты за работник чел авторизованный по соц сервису
$function = new Twig_SimpleFunction('who_are_you', function ( $db, int $user, $folder = '', $mod_user_link_soc = '2.links_socweb_people' ) {
//whoAreYou( $db, $folder, $user, $mod_user_link = '2.links_socweb_people' ) {

    if (empty($folder)) {
        $folder = \Nyos\Nyos::$folder_now;
    }

    $r = \Nyos\mod\job_for_spec::whoAreYou($db, $folder, $user, $mod_user_link_soc);
    return $r;
    
});
$twig->addFunction($function);






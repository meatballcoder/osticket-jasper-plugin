<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Jasper Reports Integration Plugin for osTicket
 *
 * @author meatballcoder
 */

set_include_path(get_include_path().PATH_SEPARATOR.dirname(__file__).'/include');
return array(
    'id' =>             'meatballcoder:jasper_reports', # notrans
    'version' =>        '0.1',
    'name' =>           'osTicketJasperReports',
    'author' =>         'meatballcoder',
    'description' =>    'Jasper Reports Plusing osTicket 1.9.x.',
    'url' =>            'na',
    'plugin' =>         'jasper-reports.php:JasperReportPlugin'
);

?>
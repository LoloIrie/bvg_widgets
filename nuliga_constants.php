<?php
/**
 * Created by PhpStorm.
 * User: ldorier
 * Date: 22.09.2016
 * Time: 14:47
 */


define( 'NULIGA_DOMAIN', 'http://hbv-badminton.liga.nu' );

$NULIGA_TEAMS_NAMES = array(
    'A1' => '1. Mannschaft',
    'A2' => '2. Mannschaft',
    'A3' => '3. Mannschaft',
    'A4' => '4. Mannschaft',
    'A5' => '5. Mannschaft',

    'J1' => 'Jugend 1',
    'J2' => 'Jugend 2',
    'J3' => 'Jugend 3',

    'S1' => 'Schüler 1'
);
$GOOGLE_CALENDARS_EXTRAS = array(
    'GH' => 'Goldbach Halle',
    'LH' => 'Laufach Halle',
    'SC' => 'Schulsport',
    'T' => 'Turniere'
);
$GOOGLE_CALENDARS_NAMES = array_merge( $NULIGA_TEAMS_NAMES , $GOOGLE_CALENDARS_EXTRAS );

/* 2016-2017 */
$NULIGA_TEAMS_TABLE_URL = array(
    'A1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=HBV+16%2F17&group=22191', // Senior 1
    'A2' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+16%2F17&group=22195', // Senior 2
    'A3' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+16%2F17&group=22197', // Senior 3
    'A4' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+16%2F17&group=22196', // Senior 4
    'A5' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+16%2F17&group=22203', // Senior 5

    'J1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+16%2F17&group=22217', // Jugend 1

    'S1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+16%2F17&group=22233', // Schüler 1
    'S2' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+16%2F17&group=22232', // Schüler 2

    'U13_1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+16%2F17&group=22235', // U13
);
$NULIGA_TEAMS_CALENDAR_URL = array(
    'A1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=159092&championship=HBV+16%2F17&group=22191', // Senior 1
    'A2' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=158462&championship=Frankfurt+16%2F17&group=22195', // Senior 2
    'A3' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=159310&championship=Frankfurt+16%2F17&group=22197', // Senior 3
    'A4' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=159357&championship=Frankfurt+16%2F17&group=22196', // Senior 4
    'A5' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=159403&championship=Frankfurt+16%2F17&group=22203', // Senior 5

    'J1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=158660&championship=Frankfurt+16%2F17&group=22217', // Jugend 1

    'S1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=158736&championship=Frankfurt+16%2F17&group=22233', // Schüler 1
    'S2' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=158753&championship=Frankfurt+16%2F17&group=22232', // Schüler 2

    'U13_1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=158768&championship=Frankfurt+16%2F17&group=22235', // U13
);


/* 2017-2018 */
$NULIGA_TEAMS_TABLE_URL = array(
    'A1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=HBV+17%2F18&group=23311', // Senior 1
    'A2' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+17%2F18&group=23317', // Senior 2
    'A3' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+17%2F18&group=23319', // Senior 3
    'A4' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+17%2F18&group=23320', // Senior 4
    'A5' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+17%2F18&group=23325', // Senior 5

    'J1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+17%2F18&group=23328', // Jugend 1
    'S1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+17%2F18&group=23411', // Jugend 2
    'S2' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+17%2F18&group=23413', // Jugend 3

    'U13_1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+17%2F18&group=23415', // Schüler 1
);

$NULIGA_TEAMS_CALENDAR_URL = array(
    'A1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=164910&championship=HBV+17%2F18&group=23311', // Senior 1
    'A2' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=165191&championship=Frankfurt+17%2F18&group=23317', // Senior 2
    'A3' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=164408&championship=Frankfurt+17%2F18&group=23319', // Senior 3
    'A4' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=164430&championship=Frankfurt+17%2F18&group=23320', // Senior 4
    'A5' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=164448&championship=Frankfurt+17%2F18&group=23325', // Senior 5

    'J1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=165881&championship=Frankfurt+17%2F18&group=23328', // Jugend 1
    'S1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=165993&championship=Frankfurt+17%2F18&group=23411', // Jugend 2
    'S2' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=165994&championship=Frankfurt+17%2F18&group=23413', // Jugend 3

    'U13_1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=165898&championship=Frankfurt+17%2F18&group=23415', // Schüler 1
);


/* 2018-2019 */
$NULIGA_TEAMS_TABLE_URL = array(
    'A1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=HBV+18%2F19&group=24711', // Senior 1
    'A2' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+18%2F19&group=24636', // Senior 2
    'A3' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+18%2F19&group=24634', // Senior 3
    'A4' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+18%2F19&group=24733', // Senior 4
    //'A5' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+18%2F19&group=23325', // Senior 5
    'J1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+18%2F19&group=24593', // Jugend 1
    'S1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+18%2F19&group=24831', // Jugend 2
    'S2' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+18%2F19&group=24832', // Jugend 3
    'U13_1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+18%2F19&group=24833', // Schüler 1
    'U13_2' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/groupPage?championship=Frankfurt+18%2F19&group=24837', // Schüler 2
);
$NULIGA_TEAMS_CALENDAR_URL = array(
    'A1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=172512&championship=HBV+18%2F19&group=24711', // Senior 1
    'A2' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=172106&championship=Frankfurt+18%2F19&group=24636', // Senior 2
    'A3' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=172081&championship=Frankfurt+18%2F19&group=24634', // Senior 3
    'A4' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=172706&championship=Frankfurt+18%2F19&group=24733', // Senior 4
    //'A5' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=164448&championship=Frankfurt+18%2F19&group=23325', // Senior 5
    'J1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=173317&championship=Frankfurt+18%2F19&group=24593', // Jugend 1
    'S1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=173345&championship=Frankfurt+18%2F19&group=24831', // Jugend 2
    'S2' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=173389&championship=Frankfurt+18%2F19&group=24832', // Jugend 3
    'U13_1' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=173420&championship=Frankfurt+18%2F19&group=24833', // Schüler 1
    'U13_2' => NULIGA_DOMAIN . '/cgi-bin/WebObjects/nuLigaBADDE.woa/wa/teamPortrait?teamtable=173454&championship=Frankfurt+18%2F19&group=24837', // Schüler 2
);


$GOOGLE_CALENDARS_IFRAMEURL = array(
    'A1' => '9gkrvvl0735cgabbigfl83upfs%40group.calendar.google.com',
    'A2' => 'vuiv5dv73i7cikk8mksodn5aqk%40group.calendar.google.com',
    'A3' => '2ue58cou3alig7s671imdbup4o%40group.calendar.google.com',
    'A4' => 'mvd9opsvhko7rr9df4om3u9p98%40group.calendar.google.com',
    'A5' => 'dh9tkhfn6e4u13a1pp3and1s3o%40group.calendar.google.com',

    'J1' => 'sb00tamhpeemujjq0tnnbgsruo%40group.calendar.google.com',
    'J2' => '4kver4d7v1kflqj4a9k28h8e44%40group.calendar.google.com',
    'J3' => 's50c6h2uslcm2h3ccutuae08d0%40group.calendar.google.com',

    'S1' => 'q45bsrrhnabig7c7510pijjsh8%40group.calendar.google.com',

    'GH' => 't54clsrqlrjth96t8p11suosmk%40group.calendar.google.com',
    'LH' => 'ktcrr05s54vskipl6119338aog%40group.calendar.google.com',
    'SC' => '288d0r2ao8cut92cnhobodehr0%40group.calendar.google.com',
    'T' => '60pc1i9pnugpvlk2br5jc24et0%40group.calendar.google.com'
);
?>
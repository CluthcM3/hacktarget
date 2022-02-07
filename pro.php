<?php

function reverseip()
{


    echo "Masukan list : ";

    $file = trim(fgets(STDIN));
    $mek = file_get_contents($file);
    $pe = explode("\r\n",$mek);
    $hitung = count($pe);

    foreach ($pe as $no=> $ip)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://api.hackertarget.com/reverseiplookup/?q=".$ip);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);


        $save = 'ress/live.txt';
        file_get_contents($save);
        $lines = count(file($save));

        $error = 'ress/unknown.txt';
        file_get_contents($error);

        $dd = 'ress/dead.txt';
        file_get_contents($dd);

        $na = $no + 1;

        $mm = $output . PHP_EOL;

        $result = "[$na/$hitung] => MENGECEK $ip";
        echo "$result\n";
        sleep(3);



        $for_error = "$ip - $output\n";


        if ($output == "API count exceeded - Increase Quota with Membership"){
            file_put_contents($error,$for_error, FILE_APPEND);
        } elseif ($output == "No DNS A records found for $ip")
        {
            file_put_contents($dd,$for_error, FILE_APPEND);
        }
        else {
            file_put_contents($save,$mm, FILE_APPEND);
        }

    }


}
reverseip();
sleep(2);
function jumla()
{
    $unknown = 'ress/unknown.txt';
    file_get_contents($unknown);
    $unknown = count(file($unknown));
    $dead = 'ress/dead.txt';
    file_get_contents($dead);
    $dead = count(file($dead));
    $live = 'ress/live.txt';
    file_get_contents($live);
    $live = count(file($live));
    echo "\n\e[32mLIVE : $live \e[39m| \e[91mDIE : $dead \e[39m| \e[90mUNKNOWN : $unknown \e[39m";
}
jumla();
<?php

namespace App\Utils;

trait Utils
{

    public function Date_ConvertSqlTab($date_sql) {
        $jour = substr($date_sql, 8, 2);
        $mois = substr($date_sql, 5, 2);
        $annee = substr($date_sql, 0, 4);
        $heure = substr($date_sql, 11, 2);
        $minute = substr($date_sql, 14, 2);
        $seconde = substr($date_sql, 17, 2);

        $key = array('annee', 'mois', 'jour', 'heure', 'minute', 'seconde');
        $value = array($annee, $mois, $jour, $heure, $minute, $seconde);

        $tab_retour = array_combine($key, $value);

        return $tab_retour;
    }

    public function AuPluriel($chiffre) {
        if($chiffre>1) {
            return 's';
        };
    }

    public function timeToJourJ($date_sql)
    {
        $tab_date = $this->Date_ConvertSqlTab($date_sql);
        $mkt_jourj = mktime(
            $tab_date['heure'],
            $tab_date['minute'],
            $tab_date['seconde'],
            $tab_date['mois'],
            $tab_date['jour'],
            $tab_date['annee']
        );

        $mkt_now = time();

        $diff = $mkt_jourj - $mkt_now;

        $unjour = 3600 * 24;

        if ($diff >= $unjour) {
            // EN JOUR
            $calcul = $diff / $unjour;
            return 'Il reste <strong>' . ceil($calcul) . ' jour' . $this->AuPluriel($calcul) .
                '</strong>.';
        } elseif ($diff < $unjour && $diff >= 0 && $diff >= 3600) {
            // EN HEURE
            $calcul = $diff / 3600;
            return 'Il reste <strong>' . ceil($calcul) . ' heure' . $this->AuPluriel($calcul) .
                '</strong>.';
        } elseif ($diff < $unjour && $diff >= 0 && $diff < 3600) {
            // EN MINUTES
            $calcul = $diff / 60;
            return 'Il reste <strong>' . ceil($calcul) . ' minute' .$this-> AuPluriel($calcul) .
                '</strong>.';
        } elseif ($diff < 0 && abs($diff) < 3600) {
            // DEPUIS EN MINUTES
            $calcul = abs($diff) / 60;
            return 'Depuis <strong>' . ceil($calcul) . ' minute' . $this->AuPluriel($calcul) .
                '</strong>.';
        } elseif ($diff < 0 && abs($diff) <= 3600) {
            // DEPUIS EN HEURES
            $calcul = abs($diff) / 3600;
            return 'Depuis <strong>' . ceil($calcul) . ' heure' . $this->AuPluriel($calcul) .
                '</strong>.';
        } else {
            // DEPUIS EN JOUR
            $calcul = abs($diff) / $unjour;
            return 'Depuis <strong>' . ceil($calcul) . ' jour' . $this->AuPluriel($calcul) .
                '</strong>.';
        };
    }
}

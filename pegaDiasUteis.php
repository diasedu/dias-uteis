<?php
function extraiDiasUteis(string $dt_inicial, string $dt_atual) : string {
    $cons_dt_inicial = new DateTime($dt_inicial);
    define('DT_INICIAL', $cons_dt_inicial->format('Y-m-d'));
    
    $dt_atual = new DateTime($dt_atual);
    $dt = new DateTime(DT_INICIAL);
    $dias_uteis = [];

    for ($i = 0; $dt < $dt_atual; $i++) {
        // Se $i == 0, $dt será igual $dt, caso contrário, $dt irá incrementar + 1 dia a partir da dt_inicial;
        $dt = (0 == $i ? $dt : $dt->add(new DateInterval('P' . + 1 . 'D')));
        
        // pega o dia da semana a partir do timestamp;
        $timestamp = $dt->getTimestamp();
        $dia_semana = getdate($timestamp)['wday'];

        // 0 e 6 significa sábado e domingo;
        $fim_semana = [0, 6];

        // verifica se a data corrente(utilizada no loop) está dentro de um fim de semana e caso sim, não vai popular o array dias_uteis;
        if (in_array($dia_semana, $fim_semana)) {
            continue;
        }
        
        $dias_uteis[] = $dia_semana;
    }

    return 'Total de dias úteis entre ' . DT_INICIAL . ' e ' .  $dt_atual->format('d/m/Y') . ': ' . count($dias_uteis);
}

$dias_uteis = extraiDiasUteis('2024-07-01', '2024-07-30');

echo $dias_uteis;

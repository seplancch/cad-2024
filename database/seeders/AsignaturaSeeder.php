<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsignaturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $asignaturas = [
            [1, '1101', 'ALG-1', 'MATEMATICAS ALG. y GEOMETRIA I', 5, 'P', 1, 2, 1],
            [2, '1102', 'COM-1', 'TALLER DE COMPUTO I', 4, 'P', 1, 2, 2],
            [3, '1103', 'QUI-1', 'QUIMICA I', 5, 'P', 2, 2, 1],
            [4, '1104', 'HUN-1', 'HISTORIA UNIVERSAL MOD. y CONT.I', 4, 'P', 3, 2, 1],
            [5, '1105', 'TLR-1', 'TALLER DE LECTURA REDACCION I', 6, 'P', 4, 2, 1],
            [6, '1106', 'FRA-1', 'FRANCES I', 4, 'P', 5, 2, 1],
            [7, '1107', 'LEX-1', 'LENGUA EXTRANJERA I', 4, 'P', 5, 2, 1],
            [8, '1201', 'ALG-2', 'MATEMATICAS ALG. y GEOMETRIA II', 5, 'N', 1, 2, 2],
            [9, '2102', 'COM-1', 'TALLER DE COMPUTO I', 4, 'N', 1, 2, 1],
            [10, '1203', 'QUI-2', 'QUIMICA II', 5, 'N', 2, 2, 2],
            [11, '1204', 'HUN-2', 'HISTORIA UNIVERSAL MOD.y CONT. II', 4, 'N', 3, 2, 2],
            [12, '1205', 'TLR-2', 'TALLER DE LECTURA REDACCION II', 6, 'N', 4, 2, 2],
            [13, '1206', 'FRA-2', 'FRANCES II', 4, 'N', 5, 2, 2],
            [14, '1207', 'LEX-2', 'LENGUA EXTRANJERA II', 4, 'N', 5, 2, 2],
            [15, '1301', 'ALG-3', 'MATEMATICAS ALG. y GEOMETRIA III', 5, 'P', 1, 2, 3],
            [16, '1302', 'FIS-1', 'FISICA I', 5, 'P', 2, 2, 3],
            [17, '1303', 'BIO-1', 'BIOLOGIA I', 5, 'P', 2, 2, 3],
            [18, '1304', 'HMX-1', 'HISTORIA DE MEXICO I', 4, 'P', 3, 2, 3],
            [19, '1305', 'TLR-3', 'TALLER DE LECTURA REDACCION III', 6, 'P', 4, 2, 3],
            [20, '1306', 'FRA-3', 'FRANCES III', 4, 'P', 5, 2, 3],
            [21, '1307', 'LEX-3', 'LENGUA EXTRANJERA III', 4, 'P', 5, 2, 3],
            [22, '1401', 'ALG-4', 'MATEMATICAS ALG. y GEOMETRIA IV', 5, 'N', 1, 2, 4],
            [23, '1402', 'FIS-2', 'FISICA II', 5, 'N', 2, 2, 4],
            [24, '1403', 'BIO-2', 'BIOLOGIA II', 5, 'N', 2, 2, 4],
            [25, '1404', 'HMX-2', 'HISTORIA DE MEXICO II', 4, 'N', 3, 2, 4],
            [26, '1405', 'TLR-4', 'TALLER DE LECTURA REDACCION IV', 6, 'N', 4, 2, 4],
            [27, '1406', 'FRA-4', 'FRANCES IV', 4, 'N', 5, 2, 4],
            [28, '1407', 'LEX-4', 'LENGUA EXTRANJERA IV', 4, 'N', 5, 2, 4],
            [29, '1501', 'CAL-1', 'CALCULO INTEGRAL Y DIFERENCIAL I', 4, 'P', 1, 2, 5],
            [31, '1503', 'EST-1', 'ESTADISTICA Y PROBABILIDAD I', 4, 'P', 1, 2, 5],
            [32, '1504', 'CYC-1', 'CIBERNETICA Y COMPUTACION  I', 4, 'P', 1, 2, 5],
            [30, '1502', 'FIL-1', 'FILOSOFIA I', 4, 'P', 3, 2, 5],
            [33, '1505', 'BIO-3', 'BIOLOGIA III', 4, 'P', 2, 2, 5],
            [34, '1506', 'FIS-3', 'FISICA   III', 4, 'P', 2, 2, 5],
            [35, '1507', 'QUI-3', 'QUIMICA  III', 4, 'P', 2, 2, 5],
            [36, '1508', 'TSF-1', 'TEMAS SELECTOS DE FILOSOFIA I', 4, 'P', 3, 2, 5],
            [37, '1509', 'ADM-1', 'ADMINISTRACION I', 4, 'P', 3, 2, 5],
            [38, '1510', 'ANT-1', 'ANTROPOLOGIA I', 4, 'P', 3, 2, 5],
            [39, '1511', 'CDS-1', 'CIENCIAS DE LA SALUD I', 4, 'P', 2, 2, 5],
            [40, '1512', 'CPS-1', 'CIENCIAS POLITICAS Y SOCIALES I', 4, 'P', 3, 2, 5],
            [41, '1513', 'DER-1', 'DERECHO   I', 4, 'P', 3, 2, 5],
            [42, '1514', 'ECO-1', 'ECONOMIA  I', 4, 'P', 3, 2, 5],
            [43, '1515', 'GEO-1', 'GEOGRAFIA I', 4, 'P', 3, 2, 5],
            [44, '1516', 'PSI-1', 'PSICOLOGIA I', 4, 'P', 2, 2, 5],
            [45, '1517', 'TDH-1', 'TEORIA DE LA HISTORIA I', 4, 'P', 3, 2, 5],
            [46, '1518', 'GRI-1', 'GRIEGO I', 4, 'P', 4, 2, 5],
            [47, '1519', 'LAT-1', 'LATIN  I', 4, 'P', 4, 2, 5],
            [48, '1520', 'ATL-1', 'LEC.ANALISIS TEXTOS LITERARIOS I', 4, 'P', 4, 2, 5],
            [49, '1521', 'TCO-1', 'TALLER DE COMUNICACION  I', 4, 'P', 4, 2, 5],
            [50, '1522', 'TDA-1', 'TALLER DISE?O AMBIENTAL I', 4, 'P', 4, 2, 5],
            [51, '1523', 'TEG-1', 'TALLER DE EXPRESION GRAFICA I', 4, 'P', 4, 2, 5],
            [52, '1601', 'CAL-2', 'CALCULO INTEGRAL Y DIFERENCIAL II', 4, 'N', 1, 2, 6],
            [54, '1603', 'EST-2', 'ESTADISTICA Y PROBABILIDAD II', 4, 'N', 1, 2, 6],
            [55, '1604', 'CYC-2', 'CIBERNETICA Y COMPUTACION  II', 4, 'N', 1, 2, 6],
            [53, '1602', 'FIL-2', 'FILOSOFIA II', 4, 'N', 3, 2, 6],
            [56, '1605', 'BIO-4', 'BIOLOGIA IV', 4, 'N', 2, 2, 6],
            [57, '1606', 'FIS-4', 'FISICA   IV', 4, 'N', 2, 2, 6],
            [58, '1607', 'QUI-4', 'QUIMICA  IV', 4, 'N', 2, 2, 6],
            [59, '1608', 'TSF-2', 'TEMAS SELECTOS DE FILOSOFIA II', 4, 'N', 3, 2, 6],
            [60, '1609', 'ADM-2', 'ADMINISTRACION II', 4, 'N', 3, 2, 6],
            [61, '1610', 'ANT-2', 'ANTROPOLOGIA II', 4, 'N', 3, 2, 6],
            [62, '1611', 'CDS-2', 'CIENCIAS DE LA SALUD II', 4, 'N', 2, 2, 6],
            [63, '1612', 'CPS-2', 'CIENCIAS POLITICAS Y SOCIALES II', 4, 'N', 3, 2, 6],
            [64, '1613', 'DER-2', 'DERECHO   II', 4, 'N', 3, 2, 6],
            [65, '1614', 'ECO-2', 'ECONOMIA  II', 4, 'N', 3, 2, 6],
            [66, '1615', 'GEO-2', 'GEOGRAFIA II', 4, 'N', 3, 2, 6],
            [67, '1616', 'PSI-2', 'PSICOLOGIA II', 4, 'N', 2, 2, 6],
            [68, '1617', 'TDH-2', 'TEORIA DE LA HISTORIA II', 4, 'N', 3, 2, 6],
            [69, '1618', 'GRI-2', 'GRIEGO II', 4, 'N', 4, 2, 6],
            [70, '1619', 'LAT-2', 'LATIN  II', 4, 'N', 4, 2, 6],
            [71, '1620', 'ATL-2', 'LEC.ANALISIS TEXTOS LITERARIOS II', 4, 'N', 4, 2, 6],
            [72, '1621', 'TCO-2', 'TALLER DE COMUNICACION  II', 4, 'N', 4, 2, 6],
            [73, '1622', 'TDA-2', 'TALLER DISEÑO AMBIENTAL II', 4, 'N', 4, 2, 6],
            [74, '1623', 'TEG-2', 'TALLER DE EXPRESION GRAFICA II', 4, 'N', 4, 2, 6],
            [90, '1202', 'EDF-1', 'EDUCACION FISICA', 4, 'N', 5, 2, 1],
        ];

        foreach ($asignaturas as $item) {
            \App\Models\Asignatura::create([
                'id' => $item[1],
                'orden' => $item[0],
                'abreviatura' => $item[2],
                'nombre' => $item[3],
                'horas' => $item[4],
                'tipo_semestre' => $item[5],
                'area' => $item[6],
                'plan' => $item[7],
                'semestre' => $item[8],
            ]);
        }
    }
}

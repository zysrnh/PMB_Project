<?php

ob_start();
include "modul/statistik/counter.php";
include "modul/statistik/online.php";
include "modul/statistik/hits.php";

$val_visitors = isset($theCount) ? (is_numeric($theCount) ? number_format($theCount, 0, ',', '.') : strip_tags($theCount)) : '0';
$val_hits = isset($hits) ? (is_numeric($hits) ? number_format($hits, 0, ',', '.') : strip_tags($hits)) : '0';
$val_month = function_exists('month') ? strip_tags(month()) : '0';
$val_day = function_exists('day') ? strip_tags(day()) : '0';
$val_now = function_exists('now') ? strip_tags(now()) : '0';

echo '
<table style="width: 100%; font-size: 13.5px; border-collapse: collapse; line-height: 2;">
    <tr style="border-bottom: 1px solid #f1f5f9;">
        <td style="padding: 4px 0; color: #64748b;"><i class="fa fa-users" style="color: #0b4d3c; width: 20px;"></i> Total Visitors</td>
        <td style="padding: 4px 0; text-align: right; font-weight: 700; color: #0f172a;">' . $val_visitors . '</td>
    </tr>
    <tr style="border-bottom: 1px solid #f1f5f9;">
        <td style="padding: 4px 0; color: #64748b;"><i class="fa fa-mouse-pointer" style="color: #0b4d3c; width: 20px;"></i> Total Hits</td>
        <td style="padding: 4px 0; text-align: right; font-weight: 700; color: #0f172a;">' . $val_hits . '</td>
    </tr>
    <tr style="border-bottom: 1px solid #f1f5f9;">
        <td style="padding: 4px 0; color: #64748b;"><i class="fa fa-calendar" style="color: #0b4d3c; width: 20px;"></i> Bulan Ini</td>
        <td style="padding: 4px 0; text-align: right; font-weight: 700; color: #0f172a;">' . $val_month . '</td>
    </tr>
    <tr style="border-bottom: 1px solid #f1f5f9;">
        <td style="padding: 4px 0; color: #64748b;"><i class="fa fa-clock-o" style="color: #0b4d3c; width: 20px;"></i> Hari Ini</td>
        <td style="padding: 4px 0; text-align: right; font-weight: 700; color: #0f172a;">' . $val_day . '</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; color: #64748b;"><i class="fa fa-circle" style="color: #22c55e; width: 20px; font-size: 11px;"></i> User Online</td>
        <td style="padding: 4px 0; text-align: right; font-weight: 700; color: #16a34a;">' . $val_now . '</td>
    </tr>
</table>';

$out = ob_get_contents();
ob_end_clean();
?>

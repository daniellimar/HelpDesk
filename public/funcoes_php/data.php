<?php

function format_data($date)
{
   $date = new DateTime($date);
   $date_format = $date->format('d/m/Y');
   return $date_format;
}
?>
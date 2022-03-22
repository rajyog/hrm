<?php

namespace App;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class utility extends Model
{

    public static function settings()
    {
        $data = DB::table('settings');
        if(\Auth::check())
        {
            $userId = \Auth::user()->creatorId();
            $data   = $data->where('created_by', '=', $userId);
        }
        else
        {
            $data = $data->where('created_by', '=', 1);
        }
        $data = $data->get();

        $settings = [

            "display_landing_page" => "on",
            "site_date_format" => "M j, Y",
            "site_time_format" => "g:i A",


        ];

        foreach($data as $row)
        {
            $settings[$row->name] = $row->value;
        }

        return $settings;
    }

    public static function setEnvironmentValue(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str     = file_get_contents($envFile);
        if(count($values) > 0)
        {
            foreach($values as $envKey => $envValue)
            {
                $keyPosition       = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine           = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                // If key does not exist, add it
                if(!$keyPosition || !$endOfLinePosition || !$oldLine)
                {
                    $str .= "{$envKey}='{$envValue}'\n";
                }
                else
                {
                    $str = str_replace($oldLine, "{$envKey}='{$envValue}'", $str);
                }
            }
        }
        $str = substr($str, 0, -1);
        $str .= "\n";
        if(!file_put_contents($envFile, $str))
        {
            return false;
        }

        return true;
    }

    public static function languages()
    {
        $dir     = base_path() . '/resources/lang/';
        $glob    = glob($dir . "*", GLOB_ONLYDIR);
        $arrLang = array_map(
            function ($value) use ($dir){
                return str_replace($dir, '', $value);
            }, $glob
        );
        $arrLang = array_map(
            function ($value) use ($dir){
                return preg_replace('/[0-9]+/', '', $value);
            }, $arrLang
        );
        $arrLang = array_filter($arrLang);

        return $arrLang;
    }


}
